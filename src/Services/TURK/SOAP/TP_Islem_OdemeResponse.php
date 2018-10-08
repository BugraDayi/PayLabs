<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 12:11
 */

namespace PayLabs\Services\TURK\SOAP;


class TP_Islem_OdemeResponse
{
    protected $TP_Islem_OdemeResult;

    /**
     * TP_Islem_OdemeResponse constructor.
     * @param $TP_Islem_OdemeResult
     */
    public function __construct($TP_Islem_OdemeResult)
    {
        $this->TP_Islem_OdemeResult = $TP_Islem_OdemeResult;
    }

    /**
     * @return mixed
     */
    public function getTPIslemOdemeResult()
    {
        return $this->TP_Islem_OdemeResult;
    }


}