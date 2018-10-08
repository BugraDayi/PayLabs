<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 8.10.2018
 * Time: 12:18
 */

namespace PayLabs\Transfer\TURK;


use PayLabs\Models\Transaction;
use PayLabs\Models\Transfer;
use PayLabs\Transfer\TransferInterface;
use PayLabs\Transfer\TransferResponse;
use PayLabs\Transfer\TURK\SOAP\TL_Transfer;
use PayLabs\Transfer\TURK\SOAP\TL_TransferResponse;

class TurkTransferService implements TransferInterface
{

    protected $transferWSDL;
    protected $soapWrapper;
    protected $G;
    protected $TurkWSDL;
    protected $commissionPercentage;
    private $service;


    public function __construct()
    {
        $this->setOptions();
    }

    public function transfer($cardNumber, $description, $amount, $commissionPercentage = NULL, $transaction_token = NULL)
    {

        if (!is_null($commissionPercentage)) {
            $amount = $amount - ($amount * $commissionPercentage);
        }

        $this->soapWrapper->add('Transfer', function ($service) {
            $service
                ->wsdl($this->transferWSDL)
                ->trace(true)
                ->classmap([
                    TL_Transfer::class,
                    TL_TransferResponse::class,
                ]);
        });
        $transferResponse = $this->soapWrapper->call('Transfer.TL_Transfer', [
            new TL_Transfer($this->G, $cardNumber, $description, $amount)
        ]);

        if ($transferResponse->getTLTransferResult()->Sonuc == 1) {

            if (!is_null($transaction_token)) {
                Transaction::where('transaction_token', $transaction_token)->update(['transferred', true]);
            }

            Transfer::create([
                'card_number' => $cardNumber,
                'description' => $description,
                'amount' => $amount,
                'transaction_token' => $transaction_token
            ]);
            return new TransferResponse(true, $transaction_token);
        }
        return new TransferResponse(false, $transaction_token);
    }

    public function check($transaction_token)
    {
        if ($transaction = Transaction::where('transaction_token', $transaction_token)->first()) {
            return $transaction->transferred;
        }
        return false;
    }

    private function setOptions()
    {
        $this->G = new G(config('PaymentServices.TURK.clientCode'), 'PaymentServices.TURK.clientUsername', 'PaymentServices.TURK.clientPassword');
        $this->transferWSDL = config('PaymentServices.TURK.transferUrl');
        $this->service = "TURK";
    }
}