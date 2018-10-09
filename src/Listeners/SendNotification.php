<?php

namespace PayLabs\Listeners;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PayLabs\Events\PaymentApproved;
use Illuminate\Support\Facades\Log;

class SendNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'notification';


    public function __construct()
    {

    }

    public function handle(PaymentApproved $event)
    {
        Log::info('Payment Approved');
        $this->delete();
    }
}
