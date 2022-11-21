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
            $table->string('status')->nullable($value = true);
            $table->date('data');
            $table->text('observacao')->nullable($value = true);
            $table->text('observacao_atuditoria')->nullable($value = true);
            $table->text('observacao2')->nullable($value = true);
            $table->text('observacao_atuditoria2')->nullable($value = true);
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
