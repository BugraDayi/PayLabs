<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 12:20
 */

namespace PayLabs\Services\TURK\SOAP;


class SHA2B64
{
    protected $Data;

    /**
     * SHA2B64 constructor.
     * @param $Data
     */
    public function __construct($Data)
    {
        $this->Data = $Data;
    }


}