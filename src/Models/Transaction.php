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
        '3d',
        'approve_token',
        'transaction_token',
        'service',
        'holder',
        'digits',
        'user_token',
        'approved',
        'commission_percentage'];

    protected $guarded = [
        'user_token',
        'amount',
        'approve_token',
        'transaction_token'
    ];
}
