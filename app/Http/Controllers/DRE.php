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
        $input_origins = InputReceipt::all();

        $input_payment = InputPayment::all();
        
        $mes = date('m');
       
        $total = DB::table('input_receipt')->select('origin_valor')->get();
        $total_produtos = $total->sum('origin_valor');


        $input = Input::where('status', 'Entrada Pendente')
         ->groupBy(\DB::raw('MONTH(created_at)'))
         ->select(\DB::raw('MONTH(created_at) as Mes, count(*) as Quantidade'))   
         ->pluck('Mes', 'Quantidade');

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
        
        return view('dre', compact([
            'methods',
            'activities',
            'origins', 
            'input_origins',
            'input_payment',
            'input'
                                  
        ]));
        
        
    }
    
}
