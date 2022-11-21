<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\DREModel;
use App\Models\Goal;

use App\Models\Origin;
use App\Models\Output;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PayingSource;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\InputPayment;
use App\Models\Input;
use App\Models\InputReceipt;


class DRE extends Controller
{
    public function index (request $request )
    {
        $methods = Output::all();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');          
        
        $input_origins = DB::table('inputs')->where('status', 'Entrada Pendente')
        ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
        ->select(\DB::raw('input_receipt.origin_id'), DB::raw('SUM(input_receipt.origin_valor) as Total'))
        ->groupBy(\DB::raw('input_receipt.origin_id'))   
        ->get();
        
        $input_payment = DB::table('inputs')->where('status', 'Entrada Pendente')
        ->join('input_payment', 'inputs.id', '=', 'input_payment.input_id')
        ->select(\DB::raw('input_payment.payment_methods_id'), DB::raw('SUM(input_payment.payment_valor) as Total'))
        ->groupBy(\DB::raw('input_payment.payment_methods_id'))   
        ->get();

       

        $mes = date('m');
       
        $total = DB::table('input_receipt')->select('origin_valor')->get();
        $total_produtos = $total->sum('origin_valor');


        $input = DB::table('inputs')->where('status', 'Entrada Pendente')
         ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
         ->select(\DB::raw('MONTH(inputs.created_at) as Mes'), DB::raw('SUM(input_receipt.origin_valor) as Total'))
         ->groupBy(\DB::raw('MONTH(created_at)'))   
         ->pluck('Mes', 'Total');

       $grafico = [1 => 0, 
            2 => 0, 
            3 => 0, 
            4 => 0, 
            5 => 0, 
            6 => 0, 
            7 => 0, 
            8 => 0, 
            9 => 0, 
            10 => 0, 
            11 => 0, 
            12 => 0];

        foreach ( $input as $key => $value ){
            $grafico[(int)$value] = (int)$key;
        }
        
        $res = DB::table('inputs')->where('status', 'Entrada Pendente')
        ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
        ->select('inputs.id', 'input_receipt.input_id', DB::raw('SUM(input_receipt.origin_valor) as total'))
        ->groupBy('inputs.id')
        ->get();
        
        return view('dre', compact([
            'methods',
            'activities',
            'origins', 
            'input_origins',
            'input_payment',
            'input', 'res', 'grafico'
                                  
        ]));
        
        
    }
    
}
