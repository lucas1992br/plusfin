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
        
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');          
        $payments = PaymentMethod::all('nome', 'id');            
        $input = Input::select("inputs.data","input_receipt.origin_id",DB::raw("MONTH(inputs.data) as mes"),DB::raw('SUM(input_receipt.origin_valor) as Total'))
        ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
        ->where('status','Entrada Pendente')
        ->groupBy(\DB::raw('MONTH(inputs.data)'),'input_receipt.origin_id')           
        ->get();

        $arrorigens = [];
        foreach($input as $inp){
            if(!in_array($inp->origin_id,$arrorigens)){
                array_push($arrorigens,$inp->origin_id);
            }           
        }   

        $dre_payment = Input::select("inputs.data","input_payment.payment_methods_id",DB::raw("MONTH(inputs.data) as mes"),DB::raw('SUM(input_payment.payment_valor) as Total'))
        ->join('input_payment', 'inputs.id', '=', 'input_payment.input_id')
        ->where('status','Entrada Pendente')
        ->groupBy(\DB::raw('MONTH(inputs.data)'),'input_payment.payment_methods_id')           
        ->get();

        $arrpayment = [];
        foreach($dre_payment as $inp){
            if(!in_array($inp->payment_methods_id,$arrpayment)){
                array_push($arrpayment,$inp->payment_methods_id);
            }           
        }   
        $arrNomeOriogin = [];
        foreach($origins as $origin){
            if(!in_array($origin->nome,$arrNomeOriogin)){
                array_push($arrNomeOriogin,$origin->nome);
            }
        }
        $arrNomePayment = [];
        foreach($payments as $payment){
            if(!in_array($payment->nome,$arrNomePayment)){
                array_push($arrNomePayment,$payment->nome);
            }
        }

        $outputs = Output::select(\DB::raw('MONTH(data) as mes'), DB::raw('SUM(valor) as Total') , 'origin_id' ,'status')
        ->groupBy(\DB::raw('MONTH(data)'), 'origin_id')
        ->get();
        
        $arroutput = [];
        foreach($outputs as $inp){
            if(!in_array($inp->origin_id,$arroutput)){
                array_push($arroutput,$inp->origin_id);
            }           
        } 
        
        $res = Input::select("inputs.data","input_receipt.origin_id",DB::raw("MONTH(inputs.data) as Mes"),DB::raw('SUM(input_receipt.origin_valor) as Total'))
        ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
        ->where('status','Entrada Pendente')
        ->groupBy(\DB::raw('MONTH(inputs.data)'))           
        ->pluck('Mes','Total');
        
        $sumOrigin = [1 => 0, 
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

        foreach ( $res as $key => $value ){
            $sumOrigin[(int)$value] = (int)$key;
        }
        $respayment = Input::select("inputs.data","input_payment.payment_methods_id",DB::raw("MONTH(inputs.data) as Mes"),DB::raw('SUM(input_payment.payment_valor) as Total'))
        ->join('input_payment', 'inputs.id', '=', 'input_payment.input_id')
        ->where('status','Entrada Pendente')
        ->groupBy(\DB::raw('MONTH(inputs.data)'))           
        ->pluck('Mes','Total');
        
        $sumPayment = [1 => 0, 
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

        foreach ( $respayment as $key => $value ){
            $sumPayment[(int)$value] = (int)$key;
        }
               
        $resoutput = Output::select(\DB::raw('MONTH(data) as Mes'), DB::raw('SUM(valor) as Total'))
        ->groupBy(\DB::raw('MONTH(data)'))           
        ->pluck('Mes','Total');
        
        $sumOutput = [1 => 0, 
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

        foreach ( $resoutput as $key => $value ){
            $sumOutput[(int)$value] = (int)$key;
        }
        
        
        return view('dre', compact([
            'outputs',
            'activities',
            'origins', 
            'input',
            'arrorigens',
            'dre_payment',
            'arrpayment',
            'arrNomeOriogin',
            'arrNomePayment',
            'arroutput',
            'sumOrigin',
            'sumPayment',
            'sumOutput'                        
        ]));
        

       /*$grafico = [1 => 0, 
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
        
        
        
        return view('dre', compact([
            'methods',
            'activities',
            'origins', 
            'input_origins',
            'input_payment',
            'input', 'res', 'grafico'
                                  
        ]));
        */
        
    }
    
}
