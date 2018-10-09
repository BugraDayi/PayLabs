<?php

namespace PayLabs;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PayLabs\Events\PaymentApproved;
use PayLabs\Listeners\MoneyTransfer;
use PayLabs\Listeners\SendNotification;

class PayLabsEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaymentApproved::class => [
            MoneyTransfer::class,
            SendNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
