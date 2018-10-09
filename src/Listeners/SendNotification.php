<?php

namespace PayLabs\Listeners;

use App\Sms\KobikomSmsService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PayLabs\Events\PaymentApproved;

class SendNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'notification';
    public $smsService;
    public $activationMessage;

    public function __construct()
    {
        $this->smsService = new KobikomSmsService();
    }

    private function prepareMessage($amount){
        return $amount. "TL ODEMENIZ ONAYLANDI";
    }

    public function handle(PaymentApproved $event)
    {
        $this->smsService->send($event->phone,$this->prepareMessage($event->transaction->amount));
        $this->delete();
    }
}
