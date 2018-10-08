<?php

namespace PayLabs\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'service_token', 'user_token', 'number',
        'holder', 'cvc', 'service',
        'month', 'year'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'service_token',
        'user_token', 'cvc', 'month', 'year', 'service'
    ];

    public function getNumberAttribute($value)
    {
        return decrypt($value);
    }

    public function getServiceTokenAttribute($value)
    {
        return decrypt($value);
    }

    public function getMonthAttribute($value)
    {
        return decrypt($value);
    }

    public function getYearAttribute($value)
    {
        return decrypt($value);
    }

    public function getCvcAttribute($value)
    {
        return decrypt($value);
    }

    public function getHolderAttribute($value)
    {
        return decrypt($value);
    }

    public function setHolderAttribute($value)
    {
        $this->attributes['holder'] = encrypt($value);
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = encrypt($value);
    }

    public function setYearAttribute($value)
    {
        $this->attributes['year'] = encrypt($value);
    }

    public function setMonthAttribute($value)
    {
        $this->attributes['month'] = encrypt($value);
    }

    public function setCvcAttribute($value)
    {
        $this->attributes['cvc'] = encrypt($value);
    }

    public function setServiceTokenAttribute($value)
    {
        $this->attributes['service_token'] = encrypt($value);
    }
}
