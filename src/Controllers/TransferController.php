<?php

namespace PayLabs\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayLabs\Facades\PayLabsTransfer;


class TransferController extends Controller
{

    public function transfer(Request $request){

        //$cardNumber = "";//
        $cardNumber = ""; //

        $description = "Test";
        $amount = 0.1;

        return [
            'transfer' => (PayLabsTransfer::transfer($cardNumber,$description,$amount))->getResult()
        ];
    }
}
