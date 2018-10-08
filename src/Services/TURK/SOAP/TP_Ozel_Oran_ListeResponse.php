<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 01:46
 */

namespace PayLabs\Services\TURK\SOAP;


class TP_Ozel_Oran_ListeResponse
{

    protected $TP_Ozel_Oran_ListeResult;

    /**
     * TP_Ozel_Oran_ListeResponse constructor.
     * @param $DT_Bilgi
     * @param $Sonuc
     * @param $Sonuc_Str
     */
    public function __construct($TP_Ozel_Oran_ListeResult)
    {
        $this->TP_Ozel_Oran_ListeResult = $$TP_Ozel_Oran_ListeResult;
    }

    /**
     * @return mixed
     */
    public function getTPOzelOranListeResult()
    {
        return $this->TP_Ozel_Oran_ListeResult;
    }

}