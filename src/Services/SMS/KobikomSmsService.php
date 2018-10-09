<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 30.03.2018
 * Time: 00:50
 */

namespace App\Sms;


use GuzzleHttp\Client;
use Spatie\ArrayToXml\ArrayToXml;

class KobikomSmsService implements SmsInterface
{
    public function send($number, $content = null, $date = '')
    {
        $array = [
            'dogrulama' => [
                'kullanici' => config('NotificationServices.Notification.Kobikom.user'),
                'parola' => config('NotificationServices.Notification.Kobikom.pass')
            ],
            'mesajiniz' => [
                'baslik' => config('NotificationServices.Notification.sender'),
                'metin' => $content,
                'datacoding' => '8',
                'type' => 'longSMS',
                'languageCode' => 'TR',
                'alicilar' => [
                    'gsm'=> str_replace('+',NULL,
                            str_replace(' ',NULL,$number))
                ]
            ],
        ];


        $XMLRequest = ArrayToXml::convert($array,'SMS');
        $XMLRequest = str_replace('<?xml version="1.0"?>',NULL,$XMLRequest);
        $client = new Client();

        $response = $client->request('POST', config('NotificationServices.Notification.Kobikom.url'), [
            'body' => $XMLRequest
        ]);

        return $response;
    }

    public function sendGroup($group, $content)
    {
        // TODO: Implement sendGroup() method.
    }

}