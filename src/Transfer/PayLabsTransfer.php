<?php

namespace PayLabs\Transfer;

use PayLabs\Services\TURK\TurkTransferService;

class PayLabsTransfer
{
    protected $transferService;

    public function __construct()
    {
        $this->transferService = new TurkTransferService();
    }

    public function transfer($cardNumber, $description, $amount, $commissionPercentage = NULL, $transaction_token = NULL){

        return $this->transferService->transfer($cardNumber, $description, $amount,$commissionPercentage,$transaction_token);
    }

}