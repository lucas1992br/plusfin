<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputs', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->date('data');
            $table->text('conta');
            $table->text('observacao')->nullable($value = true);
            $table->text('observacao_atuditoria')->nullable($value = true);
            $table->text('observacao2')->nullable($value = true);
            $table->text('observacao_atuditoria2')->nullable($value = true);
            $table->decimal('valor', $precision = 8, $scale = 2);
            $table->foreignId('activity_id');
            $table->foreignId('paying_sources_id');
            $table->foreignId('payment_methods_id');
            $table->foreignId('origin_id');
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
        Schema::dropIfExists('outputs');
    }
}
