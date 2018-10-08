<?php

namespace PayLabs\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayLabs\Facades\PayLabs;
use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Resources\PaymentResource;

class PaymentController extends Controller
{

    public function pay(Request $request){

        $transaction = new Transaction();
        $transaction->amount = 4;
        $transaction->description = 'test';
        $transaction->installment = 1;
        $transaction->threeds = 1;
        $transaction->user_token = "test_token";
        $transaction->ip = $request->ip();

        $creditCard = new CreditCard();
        $creditCard->holder = "test";
        $creditCard->number = '1234123412341234';
        $creditCard->year = "12";
        $creditCard->month = "12";
        $creditCard->ccv = "123";

        $urls = [
            'paymentURL' => 'test',
            'failURL' => 'fail',
            'successURL' => 'scs'
        ];

        return new PaymentResource(PayLabs::makePayment($transaction,$creditCard,$urls));
    }
}
