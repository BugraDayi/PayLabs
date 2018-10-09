<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 9.10.2018
 * Time: 19:08
 */
return [
    'Notification' => [
        'sender' => env('NOTIFICATION_SENDER', ''),
        'Kobikom' => [
            'url' => env('KOBIKOM_URL', ''),
            'user' => env('KOBIKOM_USER', ''),
            'pass' => env('KOBIKOM_PASS', ''),
        ]
    ]
];