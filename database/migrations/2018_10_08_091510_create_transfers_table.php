<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number');
            $table->string('description');
            $table->string('transaction_token')->nullable();
            $table->string('transfer_token')->nullable();
            $table->decimal('amount',5,2);
            $table->boolean('transferred')->default(0);
            $table->boolean('will_transfer')->default(0);
            $table->string('phone')->nullable();
            $table->float('commission_percentage')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
