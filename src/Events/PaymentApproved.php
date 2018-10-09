<?php

namespace PayLabs\Events;

use Illuminate\Queue\SerializesModels;

class PaymentApproved
{
    use SerializesModels;

    public $transaction;


    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
}
