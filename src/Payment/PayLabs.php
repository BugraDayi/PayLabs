<?php

namespace PayLabs\Payment;

use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Services\TURK\TurkPaymentService;
use Illuminate\Support\Collection;

class PayLabs
{
    protected $paymentService;
    protected $paymentServices;

    public function __construct($paymentService = NULL)
    {
        $this->paymentServices = new Collection([
            array_keys(config('PaymentServices'))
        ]);

        $this->activatePaymentService($paymentService);
    }

    public function makePayment(Transaction $transaction,CreditCard $creditCard,$urls){

        $this->createTransaction($transaction,$creditCard->holder,$creditCard->number);
        $this->addURL($urls,$transaction);

        $paymentResponse = $this->paymentService->pay($transaction,$creditCard);

        if($paymentResponse->getResult() == true && $creditCard->save == true){
            $creditCard->save();
        }

        return $paymentResponse;
    }

    public function createTransaction($transaction,$holder,$digits){
        $transaction->approve_token = rand(100,999999).str_random(16).time().str_random(16).rand(100,999999);
        $transaction->transaction_token = 'txid'.str_random(10).time().str_random(10);
        $transaction->holder = $holder;
        $transaction->digits = substr($digits,0,4);
        $transaction->save();
    }

    public function saveCreditCard($creditCardParams){

        if($this->validateCreditCard($creditCardParams)){
            return CreditCard::create($creditCardParams);
        }
    }

    private function addURL($urls,Transaction $transaction){
        $transaction->paymentURL = $urls['paymentURL'];
        $transaction->successURL = $urls['successURL'].$transaction->approve_token;
        $transaction->failURL = $urls['failURL'].$transaction->transaction_token;
    }

    private function validateCreditCard(){
        return true;
    }

    private function activatePaymentService($paymentService){

        switch ($paymentService){
            case 'TURK':
                $this->paymentService = new TurkPaymentService();
                break;

            default:
                $this->paymentService = new TurkPaymentService();
            break;
        }
    }
}