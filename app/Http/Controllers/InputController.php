<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Input;
use App\Models\Origin;

use App\Models\Output;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\InputOrigin;
use App\Models\InputPayment;

use App\Models\InputReceipt;
use App\Models\PayingSource;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\StoreInputRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateInputRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $methods = Input::all();
        $origins = Origin::where('status','Ativo')->where('tipo','Entrada')->get();
        $payments_methods = PaymentMethod::where('status','Ativo')->where('tipo','Entrada')->get();
        $payings_sources = PayingSource::all('nome', 'id');
       
        if($request->data_inicial_search && $request->data_final_search){

            $data_inicio = $request->data_inicial_search;
            $data_fim    = $request->data_final_search;

            $methods = Input::where('data', '>=', $data_inicio)->where('data', '<=', $data_fim)->get();           
        }
        
       
        return view('input', compact([
            'methods',
            'origins',
            'payments_methods',
            'payings_sources',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $banco = str_replace('.','',$request->banco);
        $banco = str_replace(',','.',$banco);

        if($request->all()){
            Input::create([
                'status' =>$request->status = 'Entrada Efetuada',
                'data' => $request->data,
                'valor_payment7' => $banco,
                'valor_payment_total' => $banco,
            ]);
            return Redirect::route('entradas.index');
        }
        else
        {
            return Redirect::route('entradas.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInputRequest $request)
    {           
        $input = new Input();
        $input->data = $request->data;
        $input->status = 'Entrada Pendente';
        $input->save();

        return $input->id;

        //return Redirect::route('entradas.index');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = Input::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function edit(Input $input)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInputRequest  $request
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInputRequest $request, $entrada)
    {  
        $origin_valor = str_replace('.','',$request->origin_valor);
        $origin_valor = str_replace(',','.',$origin_valor);
       
        $payment_valor = str_replace('.','',$request->payment_valor);
        $payment_valor = str_replace(',','.',$payment_valor);

        $input = new InputReceipt();
        $input->input_id = $entrada;
        $input->origin_id = $request->get('origin_id');
        $input->origin_valor = $origin_valor;
        $input->save();
        
        $inputPayment = new InputPayment();
        $inputPayment->input_id = $entrada;
        $inputPayment->payment_methods_id = $request->get('payment_methods_id');
        $inputPayment->payment_valor = $payment_valor;
        $inputPayment->save();
        
        return Redirect::route('entradas.index');
        
    }
    
    public function detalhes(UpdateInputRequest $request)
    {       
        $origin_valor = str_replace('.','',$request->origin_valor);
        $origin_valor = str_replace(',','.',$origin_valor);
       
        $payment_valor = str_replace('.','',$request->payment_valor);
        $payment_valor = str_replace(',','.',$payment_valor);

        $input = new InputReceipt();
        $input->input_id = $request->id;
        $input->origin_id = $request->get('origin_id');
        $input->origin_valor = $origin_valor;
        $input->save();

        $inputPayment = new InputPayment();
        $inputPayment->input_id = $request->id;
        $inputPayment->payment_methods_id = $request->get('payment_methods_id');
        $inputPayment->payment_valor = $payment_valor;
        $inputPayment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Input::find($id);
        $item->InputReceipt()->detach();
        $item->InputPayment()->detach();

        return response('Deletado com sucesso.', 200);    
        return Redirect::route('entradas.index');
    }
}
