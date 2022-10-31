<?php

namespace App\Models;

use App\Models\Output;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DREModel extends Model
{
    use HasFactory;

    public function origens($mes){
        $query = Input::where('status', 'Entrada Efetuada')
        ->whereMonth('created_at', $mes) 
        ->select(DB::raw('SUM(valor_payment) as dinheiro'), 
        DB::raw('SUM(valor_payment2) as pix'), 
        DB::raw('SUM(valor_payment3) as cheque'), 
        DB::raw('SUM(valor_payment4) as debito'),
        DB::raw('SUM(valor_payment5) as credito'),
        DB::raw('SUM(valor_payment6) as recorrente'),
        DB::raw('SUM(valor_payment_total) as total'),
        DB::raw('SUM(valor_payment7) as banco')) 
        ->get();
        return $query;       
    }
    public function origens_somatoria($ano, $tabela){
        $query = Input::where('status', 'Entrada Efetuada')
        ->whereYear('created_at', '=', $ano) 
        ->select(DB::raw('SUM('.$tabela.') as total')) 
        ->get();
        return $query;       
    }
    public function origens_total($mes){
        $query = Input::where('status', 'Entrada Efetuada')
        ->whereMonth('created_at', $mes) 
        ->select(DB::raw('SUM(valor_payment_total) as total')) 
        ->get();
        return $query;       
    }
    public function custos($mes){
        $query = Output::where('status', 'Paga')
        ->whereMonth('created_at', $mes)
        ->select('origin_id', DB::raw('SUM(valor) as total'))              
        ->groupBy('origin_id')
        ->get();
        return $query;       
    }
    public function formapagamento($mes){
        $query = Output::where('status', 'Paga')
        ->whereMonth('created_at', $mes)
        ->select('payment_methods_id', DB::raw('SUM(valor) as total_sales'))              
        ->groupBy('payment_methods_id')
        ->get();
        return $query;
    }
}
