<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Http\Requests\StoreInputRequest;
use App\Http\Requests\UpdateInputRequest;

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

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Input::all();
        $origins = Origin::where('status','Ativo')->where('tipo','Entrada')->get();
        $payments_methods = PaymentMethod::where('status','Ativo')->where('tipo','Entrada')->get();
        $payings_sources = PayingSource::all('nome', 'id');
        return view('input', compact([
            'methods',
            'origins',
            'payments_methods',
            'payings_sources'
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
     * @param  \App\Http\Requests\StoreInputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInputRequest $request)
    {   
        $dinheiro = str_replace('.','',$request->dinheiro);
        $dinheiro = str_replace(',','.',$dinheiro);

        $pix = str_replace('.','',$request->pix);
        $pix = str_replace(',','.',$pix);

        $cheque = str_replace('.','',$request->cheque);
        $cheque = str_replace(',','.',$cheque);

        $cartao_debito = str_replace('.','',$request->cartao_debito);
        $cartao_debito = str_replace(',','.',$cartao_debito);

        $cartao_credito = str_replace('.','',$request->cartao_credito);
        $cartao_credito = str_replace(',','.',$cartao_credito);

        $cartao_recorrente = str_replace('.','',$request->cartao_recorrente);
        $cartao_recorrente = str_replace(',','.',$cartao_recorrente);

        $banco = str_replace('.','',$request->banco);
        $banco = str_replace(',','.',$banco);

        if($request->all()){
            Input::create([
                'status' =>$request->status = 'Entrada Pendente',
                'data' => $request->data,
                'observacao' => $request->observacao,
                'observacao_atuditoria' => $request->observacao_atuditoria,
                'observacao2' => $request->observacao2,
                'observacao_atuditoria2' => $request->observacao_atuditoria2,
                'payment_methods_id' => $request->payment_methods_id,
                'payment_methods_id2' => $request->payment_methods_id2,
                'payment_methods_id3' => $request->payment_methods_id3,
                'payment_methods_id4' => $request->payment_methods_id4,
                'payment_methods_id5' => $request->payment_methods_id5,
                'payment_methods_id5' => $request->payment_methods_id6,
                'payment_methods_id5' => $request->payment_methods_id7,
                'payment_methods_id5' => $request->payment_methods_id8,
                'payment_methods_id5' => $request->payment_methods_id9,
                'valor_payment' => $dinheiro,
                'valor_payment2' => $pix,
                'valor_payment3' => $cheque,
                'valor_payment4' => $cartao_debito,
                'valor_payment5' => $cartao_credito,
                'valor_payment6' => $cartao_recorrente,
                'valor_payment7' => $banco,
                'valor_payment8' => $request->valor_payment8,
                'valor_payment9' => $request->valor_payment9,
                'valor_payment_total' => $request->valor_payment_total,
                'origin_id' => $request->origin_id,
                'origin_id2' => $request->origin_id2,
                'origin_id3' => $request->origin_id3,
                'origin_id4' => $request->origin_id4,
                'origin_id5' => $request->origin_id5,
                'valor_origin' => $request->valor_origin,
                'valor_origin2' => $request->valor_origin2,
                'valor_origin3' => $request->valor_origin3,
                'valor_origin4' => $request->valor_origin4,
                'valor_origin5' => $request->valor_origin5,
                'valor_payment_origin'  => $request->valor_payment_origin,
            ]);

            return Redirect::route('entradas.index');
        }
        else
        {
            return Redirect::route('entradas.index');
        }
        
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
    public function update(UpdateInputRequest $request, Input $input)
    {
        //
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
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
