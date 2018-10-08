<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 18:08
 */

namespace PayLabs\Services\TURK\SOAP;


class TL_TransferResponse
{
    protected $TL_TransferResult;

    /**
     * TL_TransferResponse constructor.
     * @param $TL_TransferResult
     */
    public function __construct($TL_TransferResult)
    {
        $this->TL_TransferResult = $TL_TransferResult;
    }

    /**
     * @return mixed
     */
    public function getTLTransferResult()
    {
        return $this->TL_TransferResult;
    }




}