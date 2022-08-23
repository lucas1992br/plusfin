<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('name');
            $table->string('razao_social')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone');
            $table->string('reponsavel')->nullable();
            $table->string('responsavel_telefone')->nullable();
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('infos_adicionais')->nullable();
            $table->string('avatar')->default('storage/users/default.png')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('customer_suppliers');
    }
}
