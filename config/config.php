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
        'posId'  => env( 'TURK_POS_ID', '1008'),
        'commissionPercentage' => env( 'TURK_COMMISSION_PERCENTAGE', '' ),
    ],

    'iyzico' => [

    ]

];