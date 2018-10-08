<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 16:28
 */

return [
   'TURK' =>

    [
        'baseUrl'       => env( 'TURK_BASE_URL', '' ),
        'transferUrl'    => env( 'TURK_TRANSFER_URL', '' ),
        'guid'        => env( 'TURK_GUID', '' ),
        'posId'  => env( 'TURK_POS_ID', ''),
        'commissionPercentage' => env( 'TURK_COMMISSION_PERCENTAGE', '' ),
        'clientCode' => env( 'TURK_CLIENT_CODE', '' ),
        'clientUsername' => env( 'TURK_CLIENT_USERNAME', '' ),
        'clientPassword' => env( 'TURK_CLIENT_PASSWORD', '' ),
    ],

    'iyzico' => [

    ]

];