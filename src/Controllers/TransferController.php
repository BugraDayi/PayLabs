<?php

namespace PayLabs\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayLabs\Facades\PayLabsTransfer;


class TransferController extends Controller
{

    public function transfer(Request $request){

        $cardNumber = "";// Anki

        $description = "Test";
        $amount = 0.46;

        return [
            'transfer' => (PayLabsTransfer::transfer($cardNumber,$description,$amount))->getResult()
        ];
    }
}
