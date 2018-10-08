<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 8.10.2018
 * Time: 02:43
 */

namespace PayLabs\Payment;

class PaymentResponse
{
    private $result;
    private $redirectURL;
    private $transactionID;
    private $error;

    public function __construct($result,$url,$transaction_id,$error = NULL)
    {
        $this->result = $result;
        $this->redirectURL = $url;
        $this->transactionID = $transaction_id;
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getTransactionID()
    {
        return $this->transactionID;
    }

    /**
     * @return mixed
     */
    public function getRedirectURL()
    {
        return $this->redirectURL;
    }

}