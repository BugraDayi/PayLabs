<?php

namespace PayLabs\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PayLabs\Events\PaymentApproved;
use PayLabs\Facades\PayLabs;
use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Models\Transfer;
use PayLabs\Resources\PaymentResource;
use PayLabs\Traits\ApiResponse;

class PaymentController extends Controller
{
    use ApiResponse;

    public function pay(Request $request)
    {

        $request->validate([
            'number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'holder' => 'required',
            'cvc' => 'required',

            'amount' => 'required',
            'description' => 'required',
            'threeds' => 'required',
            'service' => 'required',
            'user_token' => 'required',
            'ip' => 'required',

            'success_url' => 'required',
            'fail_url' => 'required',
            'payment_url' => 'required'
        ]);

        $transaction = new Transaction();
        $transaction->fill($request->all());

        $creditCard = new CreditCard();
        $creditCard->fill($request->all());

        $urls = [
            'paymentURL' => $request->payment_url,
            'failURL' => $request->fail_url,
            'successURL' => $request->success_url
        ];

        $paymentResponse = new PaymentResource(PayLabs::makePayment($transaction, $creditCard, $urls));
        if ($paymentResponse->result() && $request->transfer) {
            Transfer::create([
                'card_number' => $request->debit_card,
                'will_transfer' => 1,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'description' => $request->description,
                'commission_percentage' => $request->commission_percentage,
                'transaction_token' => $paymentResponse->transactionToken()
            ]);
        }

        return $paymentResponse;
    }

    public function approve(Request $request)
    {
        if ($transaction = Transaction::where('approved', 0)->where('transaction_token', $request->transaction_token)->first()) {

            if (Hash::check($request->approve_token, $transaction->approve_token)) {

                if ($transfer = Transfer::where('will_transfer', 1)->where('transaction_token', $request->transaction_token)->first()) {
                    //Send money
                    event(new PaymentApproved(
                        $transaction,
                        $transfer->card_number,
                        $transfer->commission_percentage,
                        $transfer->phone
                    ));
                }

                $transaction->update([
                    'approved' => true
                ]);

                return $this->successResponse('Transaction approved', 200);
            }

            return $this->errorResponse('Hash does not math', 101, 400);
        }

        return $this->errorResponse('Transaction not found', 100, 404);
    }
}
