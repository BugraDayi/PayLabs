<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 29.03.2018
 * Time: 18:31
 */

namespace App\Sms;


interface SmsInterface
{
    public function send($number, $content = null, $zaman = '');

    public function sendGroup($group,$content);
}