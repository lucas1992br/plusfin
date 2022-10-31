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



class DRE extends Controller
{
    public function index (request $request )
    {
        $methods = Output::all();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');          
       /* Origens */

        /* Forma Pagamento Mês */
        $F01 = DREModel::origens('1');
        
        $F01t = DREModel::origens_total('1');

        $F02 = DREModel::origens('2');
        $F02t = DREModel::origens_total('2');

        $F03 = DREModel::origens('3');
        $F03t = DREModel::origens_total('3');

        $F04 = DREModel::origens('4');
        $F04t = DREModel::origens_total('4');

        $F05 = DREModel::origens('5');
        $F05t = DREModel::origens_total('5');

        $F06 = DREModel::origens('6');
        $F06t = DREModel::origens_total('6');

        $F07 = DREModel::origens('7');
        $F07t = DREModel::origens_total('7');

        $F08 = DREModel::origens('8');
        $F08t = DREModel::origens_total('8');

        $F09 = DREModel::origens('9');
        $F09t = DREModel::origens_total('9');

        $F10 = DREModel::origens('10');
        $F10t = DREModel::origens_total('10');

        $F11 = DREModel::origens('11');
        $F11t = DREModel::origens_total('11');

        $F12 = DREModel::origens('12');
        $F12t = DREModel::origens_total('12');

        $ano = date('Y');
        $somatoria_dinheiro = DREModel::origens_somatoria($ano, 'valor_payment');
        $somatoria_pix = DREModel::origens_somatoria($ano, 'valor_payment2');
        $somatoria_cheque = DREModel::origens_somatoria($ano, 'valor_payment3');
        $somatoria_debito = DREModel::origens_somatoria($ano, 'valor_payment4');
        $somatoria_credito = DREModel::origens_somatoria($ano, 'valor_payment5');
        $somatoria_recorrente = DREModel::origens_somatoria($ano, 'valor_payment6');
        $somatoria_banco = DREModel::origens_somatoria($ano, 'valor_payment7');
        $somatoria_total = DREModel::origens_somatoria($ano, 'valor_payment_total');
        /* Final Forma Pagamento Mês */

        $custos1 = DREModel::custos('10');
        $custos11 = DREModel::custos('11');
        $custos12 = DREModel::custos('12');
        $login = Auth::user()->id;

        $teste = DREModel::origens('2022');
        return view('dre', compact([
            'methods',
            'activities',
            'origins',             
            'F01', 'F02', 'F03', 'F04', 'F05', 'F06', 'F07', 'F08', 'F09', 'F10', 'F11', 'F12', 
            'F01t', 'F02t', 'F03t', 'F04t', 'F05t', 'F06t', 'F07t', 'F08t', 'F09t', 'F10t', 'F11t', 'F12t',
            'somatoria_dinheiro', 'somatoria_pix', 'somatoria_cheque', 'somatoria_debito', 'somatoria_credito', 'somatoria_recorrente', 'somatoria_banco','somatoria_total',
            'custos1', 'custos12','custos11'
            
        ]));
        
        
    }
    
}
