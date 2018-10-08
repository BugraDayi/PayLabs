<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 12:21
 */

namespace PayLabs\Services\TURK\SOAP;


class SHA2B64Response
{
    protected $SHA2B64Result;

    /**
     * SHA2B64Response constructor.
     * @param $SHA2B64Result
     */
    public function __construct($SHA2B64Result)
    {
        $this->SHA2B64Result = $SHA2B64Result;
    }

    /**
     * @return mixed
     */
    public function getSHA2B64Result()
    {
        return $this->SHA2B64Result;
    }




}