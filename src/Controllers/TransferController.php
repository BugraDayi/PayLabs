<?php

namespace PayLabs\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayLabs\Facades\PayLabsTransfer;
use PayLabs\Models\Transfer;


class TransferController extends Controller
{

    public function transfer(Request $request){

        $t =Transfer::find(1);

        return [
            'transfer' => (PayLabsTransfer::transfer($t->card_number,
                'AnkiTaksi',
                $t->amount,
                $t->commission_percentage,
                $t->transaction_token))->getResult()
        ];
    }
}
