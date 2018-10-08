<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 16:08
 */


$defaultOptions = [
    'prefix' => 'transfer',
    'namespace' => '\PayLabs\Controllers',
];

Route::group($defaultOptions,function () {
    Route::get('send', 'TransferController@transfer');
});