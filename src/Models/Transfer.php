<?php

namespace PayLabs\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'card_number','description','transaction_token','amount' ,'transfer_token'
    ];

    public function transaction()
    {
        $this->belongsTo('PayLabs\Models\Transaction','transaction_token','transaction_token');
    }

}
