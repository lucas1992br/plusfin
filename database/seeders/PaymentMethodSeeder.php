<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use app\Models\PaymentMethod;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'nome' => 'Dinheiro',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Pix',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cheque',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cartão Debito',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cartão Credito',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cartão Recorrente',
            'tipo'=> 'Entrada',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Banco',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Dinheiro',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cheque a Vista',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
        DB::table('payment_methods')->insert([
            'nome' => 'Cheque Pre',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1',
        ]);
    }
}
