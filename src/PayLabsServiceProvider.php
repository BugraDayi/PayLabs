<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 7.10.2018
 * Time: 15:49
 */

namespace PayLabs;

use PayLabs\Payment\PayLabs;
use PayLabs\Transfer\PayLabsTransfer;
use Illuminate\Support\ServiceProvider;

class PayLabsServiceProvider extends ServiceProvider
{

    public function boot(){

        $this->loadRoutesFrom(__DIR__ . '/Routes/card.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/payment.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/transfer.php');
    }

    public function register(){

        $this->mergeConfigFrom(
            __DIR__ . '/config.php',
            'PaymentServices'
        );

        $this->app->bind('PayLabs', function () {
            return new PayLabs();
        });

        $this->app->bind('PayLabsTransfer', function () {
            return new PayLabsTransfer();
        });
    }
}