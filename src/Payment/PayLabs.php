<?php

namespace PayLabs\Payment;

use Illuminate\Support\Facades\Hash;
use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Services\TURK\TurkPaymentService;
use Illuminate\Support\Collection;
use SoapFault;

class PayLabs
{
    protected $paymentService;
    protected $paymentServices;
    protected $paymentServiceName;

    public function __construct($paymentService = NULL)
    {
        $this->paymentServices = new Collection([
            array_keys(config('PaymentServices'))
        ]);

        $this->activatePaymentService($paymentService);
    }

    public function makePayment(Transaction $transaction, CreditCard $creditCard, $urls)
    {
        $this->createTransaction($transaction, $creditCard->holder, $creditCard->number);
        $this->addURL($urls, $transaction);

        try {
            $paymentResponse = $this->paymentService->pay($transaction, $creditCard);
            if ($paymentResponse->getResult() == true && $creditCard->save == true) {
                $creditCard->save();
            }

            return $paymentResponse;
        } catch (\Throwable $exception) {
            Transaction::where('transaction_token',$transaction->transaction_token)->update(['approve_token' => Hash::make($transaction->approve_token)]);
            return new PaymentResponse(false,$transaction->failURL,$transaction->transaction_token
                ,'General payment service error Service:'.$this->paymentServiceName);
        }
    }

    private function createTransaction($transaction, $holder, $digits)
    {
        $transaction->approve_token = rand(100, 999999) . str_random(16) . time() . str_random(16) . rand(100, 999999);
        $transaction->transaction_token = 'txid' . str_random(10) . time() . str_random(10);
        $transaction->holder = $holder;
        $transaction->digits = substr($digits, 0, 4);
        $transaction->save();
    }

    public function saveCreditCard($creditCardParams)
    {

        if ($this->validateCreditCard($creditCardParams)) {
            return CreditCard::create($creditCardParams);
        }
    }

    private function addURL($urls, Transaction $transaction)
    {
        $transaction->paymentURL = $urls['paymentURL'];
        $transaction->successURL = $urls['successURL'] .
            "?approve_token=" . $transaction->approve_token .
            "&" . "transaction_token=" . $transaction->transaction_token;
        $transaction->failURL = $urls['failURL'] . "?transaction_token=" . $transaction->transaction_token;
    }

    private function validateCreditCard()
    {
        return true;
    }

    private function activatePaymentService($paymentService)
    {

        switch ($paymentService) {
            case 'TURK':
                $this->paymentServiceName = 'TURK';
                $this->paymentService = new TurkPaymentService();
                break;

            default:
                $this->paymentServiceName = 'TURK';
                $this->paymentService = new TurkPaymentService();
                break;
        }
    }
}