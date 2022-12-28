<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;
use App\Models\Retirada;
use App\Models\Aporte;
use App\Models\Input;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Output::all();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');
        $aporte = Aporte::all();
        $payments = PaymentMethod::all('nome', 'id');

        $inputPayment=DB::select("SELECT pm.nome as nomePagamento,ip.payment_methods_id,sum(ip.payment_valor) as total
                                        FROM plusfin_db.input_payment ip
                                            join payment_methods pm on pm.id=ip.payment_methods_id
                                                group by ip.payment_methods_id
                            ");

        $outputPayment=DB::select("SELECT pm.nome,sum(valor) as total FROM plusfin_db.outputs o join payment_methods pm on pm.id=o.payment_methods_id;");

        $arrayDRE= null;

        foreach ($outputPayment as $output){
            $arrayOutput[$output->nome]=null;
            $arrayOutput[$output->nome]['outputValue']=0;
            $arrayOutput[$output->nome]['paymentName']=$output->nome;
        }

        foreach ($inputPayment as $input){
            $arrayDRE[$input->nomePagamento]=null;
            $arrayDRE[$input->nomePagamento]['inputValue']=0;
        }


        foreach ($outputPayment as $output){
            $arrayOutput[$output->nome]['outputValue']=$output->total;
        }

        foreach ($inputPayment as $input){
            $arrayDRE[$input->nomePagamento]['inputValue']+=$input->total;
            $arrayDRE[$input->nomePagamento]['paymentName']=$input->nomePagamento;

        }


        return view('home', compact([
            'methods',
            'activities',
            'origins',
            'payings_sources' ,
            'payments_methods',
            'aporte',
            'arrayDRE',
            'arrayOutput'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeRequest  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
