<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 16:08
 */


$defaultOptions = [
    'prefix' => 'payment',
    'namespace' => '\PayLabs\Controllers',
];

Route::group($defaultOptions,function () {
    Route::post('pay', 'PaymentController@pay');
    Route::get('approve', 'PaymentController@approve');
});