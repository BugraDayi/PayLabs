<?php

namespace PayLabs\Payment;


use PayLabs\Models\CreditCard;
use PayLabs\Models\Transaction;

interface PaymentInterface
{
    public function pay(Transaction $transaction, CreditCard $creditCard);

    public function refund();

    public function check();
}