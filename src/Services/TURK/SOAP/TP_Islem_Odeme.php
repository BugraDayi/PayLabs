<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 12:06
 */

namespace PayLabs\Services\TURK\SOAP;


class TP_Islem_Odeme
{

    protected $G;
    protected $SanalPOS_ID;
    protected $GUID;
    protected $KK_Sahibi;
    protected $KK_No;
    protected $KK_SK_Ay;
    protected $KK_SK_Yil;
    protected $KK_CVC;
    protected $KK_Sahibi_GSM;
    protected $Hata_URL;
    protected $Basarili_URL;
    protected $Siparis_ID;
    protected $Siparis_Aciklama;
    protected $Taksit;
    protected $Islem_Tutar;
    protected $Toplam_Tutar;
    protected $Islem_Hash;
    protected $Islem_ID;
    protected $IPAdr;
    protected $Ref_URL;
    protected $Data1;
    protected $Data2;
    protected $Data3;
    protected $Data4;
    protected $Data5;

    /**
     * TP_Islem_Odeme constructor.
     * @param $G
     * @param $SanalPOS_ID
     * @param $GUID
     * @param $KK_Sahibi
     * @param $KK_No
     * @param $KK_SK_Ay
     * @param $KK_SK_Yil
     * @param $KK_CVC
     * @param $KK_Sahibi_GSM
     * @param $Hata_URL
     * @param $Basarili_URL
     * @param $Siparis_ID
     * @param $Siparis_Aciklama
     * @param $Taksit
     * @param $Islem_Tutar
     * @param $Toplam_Tutar
     * @param $Islem_Hash
     * @param $Islem_ID
     * @param $IPAdr
     * @param $Ref_URL
     * @param $Data1
     * @param $Data2
     * @param $Data3
     * @param $Data4
     * @param $Data5
     */
    public function __construct($G, $SanalPOS_ID, $GUID, $KK_Sahibi, $KK_No, $KK_SK_Ay, $KK_SK_Yil, $KK_CVC, $KK_Sahibi_GSM, $Hata_URL, $Basarili_URL, $Siparis_ID, $Siparis_Aciklama, $Taksit, $Islem_Tutar, $Toplam_Tutar, $Islem_Hash, $Islem_ID, $IPAdr, $Ref_URL, $Data1, $Data2, $Data3, $Data4, $Data5)
    {
        $this->G = $G;
        $this->SanalPOS_ID = $SanalPOS_ID;
        $this->GUID = $GUID;
        $this->KK_Sahibi = $KK_Sahibi;
        $this->KK_No = $KK_No;
        $this->KK_SK_Ay = $KK_SK_Ay;
        $this->KK_SK_Yil = $KK_SK_Yil;
        $this->KK_CVC = $KK_CVC;
        $this->KK_Sahibi_GSM = $KK_Sahibi_GSM;
        $this->Hata_URL = $Hata_URL;
        $this->Basarili_URL = $Basarili_URL;
        $this->Siparis_ID = $Siparis_ID;
        $this->Siparis_Aciklama = $Siparis_Aciklama;
        $this->Taksit = $Taksit;
        $this->Islem_Tutar = $Islem_Tutar;
        $this->Toplam_Tutar = $Toplam_Tutar;
        $this->Islem_Hash = $Islem_Hash;
        $this->Islem_ID = $Islem_ID;
        $this->IPAdr = $IPAdr;
        $this->Ref_URL = $Ref_URL;
        $this->Data1 = $Data1;
        $this->Data2 = $Data2;
        $this->Data3 = $Data3;
        $this->Data4 = $Data4;
        $this->Data5 = $Data5;
    }

}