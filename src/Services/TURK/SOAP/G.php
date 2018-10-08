<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 4.05.2018
 * Time: 00:59
 */

namespace PayLabs\Services\TURK\SOAP;


class G
{
    var $CLIENT_CODE,
        $CLIENT_USERNAME,
        $CLIENT_PASSWORD;

    function __construct($CLIENT_CODE,$CLIENT_USERNAME,$CLIENT_PASSWORD)
    {
        $this->CLIENT_CODE = $CLIENT_CODE;
        $this->CLIENT_USERNAME = $CLIENT_USERNAME;
        $this->CLIENT_PASSWORD = $CLIENT_PASSWORD;
    }
}