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
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payments_methods2 = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');
        return view('input', compact([
            'methods',
            'activities',
            'origins',
            'payings_sources' ,
            'payments_methods',
            'payments_methods2'
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
        if($request->all()){
            Input::create([
                'status' =>$request->status = 'Pendente',
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
                'valor_payment' => $request->valor_payment,
                'valor_payment2' => $request->valor_payment2,
                'valor_payment3' => $request->valor_payment3,
                'valor_payment4' => $request->valor_payment4,
                'valor_payment5' => $request->valor_payment5,
                'valor_payment6' => $request->valor_payment6,
                'valor_payment7' => $request->valor_payment7,
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
