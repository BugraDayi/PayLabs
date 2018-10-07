<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 15:23
 */

namespace PayLabs\TURK;

use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;
use PayLabs\Payment\PaymentInterface;

class TurkPaymentService implements PaymentInterface
{
    public function pay(Transaction $transaction, CreditCard $creditCard)
    {
        return true;
    }

    public function refund()
    {
        // TODO: Implement refund() method.
    }

    public function check()
    {
        // TODO: Implement check() method.
    }
}