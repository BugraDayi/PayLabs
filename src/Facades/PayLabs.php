<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 15:54
 */

namespace PayLabs\Facades;


use Illuminate\Support\Facades\Facade;

class PayLabs extends Facade
{
    protected static function getFacadeAccessor() { return 'PayLabs'; }

}