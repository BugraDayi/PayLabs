<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 01:32
 */

namespace PayLabs\Services\TURK\SOAP;


class TP_Ozel_Oran_Liste
{
    var $GUID,
        $G;

    /**
     * TP_Ozel_Oran_Liste constructor.
     * @param $GUID
     * @param $G
     */

    public function __construct($GUID,$G)
    {
        $this->GUID = $GUID;
        $this->G = $G;
    }
}