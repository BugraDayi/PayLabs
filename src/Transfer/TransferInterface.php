<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 16:03
 */

namespace PayLabs\Transfer;


interface TransferInterface
{
    public function transfer($cardNumber,$description,$amount,$commissionPercentage = NULL,$transaction_token = NULL);

    public function check($transaction_token);
}