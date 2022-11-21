<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('input_id');
            $table->foreign('input_id')->references('id')->on('inputs');
            $table->foreignId('payment_methods_id');
            $table->decimal('payment_valor', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('input_payment');
    }
}
