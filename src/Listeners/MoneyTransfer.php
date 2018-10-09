<?php

namespace PayLabs\Listeners;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PayLabs\Events\PaymentApproved;
use Illuminate\Support\Facades\Log;

class MoneyTransfer implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'money-transfer';


    public function __construct()
    {

    }

    public function handle(PaymentApproved $event)
    {
        if($this->attempts() < 5){

            if($this->attempts() == 4){
                Log::info('Payment Approved');
                $this->delete();
            }else{
                $this->release(10);
            }
        }else{
            $this->fail();
        }
    }
}
