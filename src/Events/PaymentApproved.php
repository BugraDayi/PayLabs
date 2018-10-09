<?php

namespace PayLabs\Events;

use Illuminate\Queue\SerializesModels;

class PaymentApproved
{
    use SerializesModels;

    public $transaction;
    public $debitCard;
    public $phone;
    public $commissionPercentage;

    public function __construct($transaction,$debitCard,$commissionPercentage = NULL,$phone = NULL)
    {
        $this->transaction = $transaction;
        $this->debitCard = $debitCard;
        $this->phone = $phone;
        $this->commissionPercentage = $commissionPercentage;
    }
}
