<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('description')->nullable();
            $table->unsignedInteger('installment')->default(1);
            $table->decimal('amount',5,2);

            $table->boolean('threeds');
            $table->string('approve_token');
            $table->string('transaction_token');
            $table->string('service_token')->nullable();

            $table->string('service',50)->nullable();

            $table->boolean('transferred')->default(false);
            $table->boolean('refund')->default(false);

            $table->string('holder');
            $table->string('digits');

            $table->string('user_token');

            $table->boolean('approved')->default(false);
            $table->ipAddress('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
