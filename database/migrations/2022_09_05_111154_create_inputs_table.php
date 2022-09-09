<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->date('data');
            $table->text('observacao')->nullable($value = true);
            $table->text('observacao_atuditoria')->nullable($value = true);
            $table->text('observacao2')->nullable($value = true);
            $table->text('observacao_atuditoria2')->nullable($value = true);
            $table->foreignId('payment_methods_id');
            $table->foreignId('payment_methods_id2')->nullable($value = true);
            $table->foreignId('payment_methods_id3')->nullable($value = true);
            $table->foreignId('payment_methods_id4')->nullable($value = true);
            $table->foreignId('payment_methods_id5')->nullable($value = true);
            $table->decimal('valor_payment', $precision = 8, $scale = 2);
            $table->decimal('valor_payment2', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_payment3', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_payment4', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_payment5', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_payment_total', $precision = 8, $scale = 2);
            $table->foreignId('origin_id');
            $table->foreignId('origin_id2')->nullable($value = true);
            $table->foreignId('origin_id3')->nullable($value = true);
            $table->foreignId('origin_id4')->nullable($value = true);
            $table->foreignId('origin_id5')->nullable($value = true);
            $table->decimal('valor_origin', $precision = 8, $scale = 2);
            $table->decimal('valor_origin2', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_origin3', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_origin4', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_origin5', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('valor_payment_origin', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('inputs');
    }
}
