<?php

namespace PayLabs\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'description',
        'installment',
        'amount',
        'threeds',
        'approve_token',
        'transaction_token',
        'service',
        'holder',
        'digits',
        'user_token',
        'approved',
        'service_token',
        'ip'];

}
