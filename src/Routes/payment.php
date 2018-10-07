<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 16:08
 */

use App\PayLabs\Facades\PayLabs;

Route::middleware(['api'])->prefix('api/payment')->group(function () {

    Route::post('test',function (){
        return PayLabs::test();
    });
});