<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use app\Models\PayingSource;

class PayingSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       
        DB::table('paying_sources')->insert([
            'nome' => 'Financeiro',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1'
        ]);
        DB::table('paying_sources')->insert([
            'nome' => 'Cartão de Crédito',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1'
        ]);
        DB::table('paying_sources')->insert([
            'nome' => 'Diretor',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1'
        ]);
        DB::table('paying_sources')->insert([
            'nome' => 'Banco',
            'tipo'=> 'Saida',
            'status'=> 'Ativo',
            'activity_id' => '1'
        ]);
    }
}
