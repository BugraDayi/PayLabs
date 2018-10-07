<?php

namespace PayLabs\Payment;

use PayLabs\TURK\TurkPaymentService;
use Illuminate\Support\Collection;

class PayLabs
{
    protected $paymentService;
    protected $paymentServices;

    public function test(){

        return config('PaymentServices.TURK');
    }

    public function __construct($paymentService = NULL)
    {
        $this->paymentServices = new Collection([
            array_keys(config('PaymentServices'))
        ]);

        if(!is_null($paymentService)){
            $this->paymentService = new TurkPaymentService();
        }else{
            $this->activatePaymentService($paymentService);
        }
    }

    public function makePayment(Collection $transaction,Collection $creditCard,$userToken){

        $new_transaction = $this->createTransaction($transaction->merge(['user_token' => $userToken]));

        $paymentResponse = $this->paymentService->pay($new_transaction,$creditCard);

        if($paymentResponse->result == true && $creditCard->save == true){
            $creditCard->save();
        }

        return $paymentResponse;
    }

    public function createTransaction($transactionParams){
        return Transaction::create([
            $transactionParams
        ]);
    }


    public function saveCreditCard($creditCardParams){

        if($this->validateCreditCard($creditCardParams)){
            return CreditCard::create($creditCardParams);
        }
    }

    private function validateCreditCard(){
        return true;
    }

    private function activatePaymentService($paymentService){

        if($this->paymentServices->contains($paymentService)){
            switch ($paymentService){

                default:
                    $this->paymentService = new TurkPaymentService();
                    break;
            }
        }else{
            $this->paymentService = new TurkPaymentService();
        }
    }
}