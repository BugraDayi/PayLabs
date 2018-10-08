<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 15:23
 */

namespace PayLabs\Services\TURK;

use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Payment\PaymentInterface;
use Artisaninweb\SoapWrapper\SoapWrapper;
use PayLabs\Payment\PaymentResponse;
use PayLabs\Services\TURK\SOAP\G;
use PayLabs\Services\TURK\SOAP\SHA2B64;
use PayLabs\Services\TURK\SOAP\SHA2B64Response;
use PayLabs\Services\TURK\SOAP\TP_Islem_Odeme;
use PayLabs\Services\TURK\SOAP\TP_Islem_OdemeResponse;

class TurkPaymentService implements PaymentInterface
{
    protected $soapWrapper;
    protected $G;
    protected $GUID;
    protected $sanalPosID;
    protected $TurkWSDL;
    protected $commissionPercentage;
    private $service;

    public function __construct()
    {
        $this->soapWrapper = new SoapWrapper();
        $this->setOptions();
    }

    public function pay(Transaction $transaction, CreditCard $creditCard)
    {
        $calculatedPrices = $this->calculatePrice($transaction->amount);
        $hashResponse = $this->getHash($transaction,$calculatedPrices);

        $this->soapWrapper->add('Payment', function ($service) {
            $service
                ->wsdl($this->TurkWSDL)
                ->trace(true)
                ->classmap([
                    TP_Islem_Odeme::class,
                    TP_Islem_OdemeResponse::class,
                ]);
        });
        $paymentResponse = $this->soapWrapper->call('Payment.TP_Islem_Odeme', [
            new TP_Islem_Odeme($this->G,$this->sanalPosID,$this->GUID,
                $creditCard->holder,
                $creditCard->number,
                $creditCard->month,
                '20'.$creditCard->year,
                $creditCard->cvc,
                '0000000000',
                $transaction->failURL,
                $transaction->successURL,
                $transaction->transaction_token,
                $transaction->description,
                $transaction->installment,
                $calculatedPrices['amount'],
                $calculatedPrices['total'],
                $hashResponse->getSHA2B64Result(),
                $transaction->order_id,
                $transaction->ip,
                $transaction->paymentURL,
                '','','','','')
        ]);

        unset($creditCard);

        $paymentResult = $paymentResponse->getTPIslemOdemeResult();
        if((int)$paymentResult->Sonuc == 1){
            $transaction->update(["service_token" => $paymentResult->Islem_ID,"service"=>$this->service]);
            return new PaymentResponse(true,str_replace(" ", NULL, $paymentResult->UCD_URL),$paymentResult->Islem_ID);
        }

        return new PaymentResponse(false
            ,str_replace(' ',NULL,$transaction->failURL)
            ,$transaction->transaction_token
            ,$paymentResult->Sonuc_Str);
    }

    private function calculatePrice($amount){

        $calculatedTotal = str_replace(".", ",", number_format($amount,2));
        $calculatedAmount = str_replace(".", ",",
            number_format($amount - ($amount * $this->commissionPercentage) ,2));

        return ['amount' => $calculatedAmount,
                'total' => $calculatedTotal];
    }

    private function getHash($transaction,$calculatedPrices){
        $this->soapWrapper->add('Hash', function ($service) {
            $service
                ->wsdl($this->TurkWSDL)
                ->trace(true)
                ->classmap([
                    SHA2B64::class,
                    SHA2B64Response::class,
                ]);
        });
        return $this->soapWrapper->call('Hash.SHA2B64', [
            new SHA2B64($this->G->CLIENT_CODE.
                $this->GUID.
                $this->sanalPosID.
                $transaction->installment.
                $calculatedPrices['amount'].
                $calculatedPrices['total'].
                $transaction->transaction_token.
                $transaction->failURL.
                $transaction->transaction_token.
                $transaction->successURL.
                $transaction->approve_token)
        ]);
    }

    private function setOptions(){
        $this->G = new G(config('PaymentServices.TURK.clientCode'),'PaymentServices.TURK.clientUsername','PaymentServices.TURK.clientPassword');
        $this->TurkWSDL = config('PaymentServices.TURK.baseUrl');
        $this->GUID = config('PaymentServices.TURK.guid');
        $this->sanalPosID = config('PaymentServices.TURK.posId');
        $this->commissionPercentage = config('PaymentServices.TURK.commissionPercentage');
        $this->service = "TURK";
    }

    public function refund()
    {
        // TODO: Implement refund() method.
    }

    public function check()
    {
        // TODO: Implement check() method.
    }
}