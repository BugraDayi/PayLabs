<?php

namespace PayLabs\Listeners;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PayLabs\Events\PaymentApproved;
use Illuminate\Support\Facades\Log;
use PayLabs\Facades\PayLabsTransfer;

class MoneyTransfer implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'money-transfer';
    private $try = 5;

    public function __construct()
    {

    }

    public function handle(PaymentApproved $event)
    {
        $transferResponse = PayLabsTransfer::transfer(
            $event->debitCard,
            $event->transaction->description,
            $event->transaction->amount,
            $event->commissionPercentage,
            $event->transaction->transaction_token
            )->getResult();

        if($transferResponse){
            $this->delete();
        }else{
           if($this->attempts() > $this->try){
               $this->release();
           }else{
               $this->fail();
           }
        }
    }
}
