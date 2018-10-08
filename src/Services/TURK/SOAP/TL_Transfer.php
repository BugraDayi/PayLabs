<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 18:06
 */

namespace PayLabs\Services\TURK\SOAP;

class TL_Transfer
{

    protected $G;
    protected $Troy_Kart_No;
    protected $Aciklama;
    protected $Tutar;

    /**
     * TL_Transfer constructor.
     * @param $G
     * @param $Troy_Kart_No
     * @param $Aciklama
     * @param $Tutar
     */
    public function __construct($G, $Troy_Kart_No, $Aciklama, $Tutar)
    {
        $this->G = $G;
        $this->Troy_Kart_No = $Troy_Kart_No;
        $this->Aciklama = $Aciklama;
        $this->Tutar = $Tutar;
    }


}