<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use App\Http\Requests\StoreAporteRequest;
use App\Http\Requests\UpdateAporteRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;
use Illuminate\Http\Request;

class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $methods = Aporte::all();
        $payments_methodcad = PaymentMethod::where('tipo','Saida')->where('status','Ativo')->get();
        $somatoria = Aporte::where('valor','>', '0')->get()->sum->valor;
        if($request->data_inicial_search && $request->data_final_search){

            $data_inicio = $request->data_inicial_search;
            $data_fim    = $request->data_final_search;

            $methods = Aporte::whereDate('data', '>=', $data_inicio)->whereDate('data', '<=', $data_fim)->get();           
        }        

        return view('aporte', compact([
            'methods',
            'payments_methodcad',
            'somatoria'
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
     * @param  \App\Http\Requests\StoreAporteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAporteRequest $request)
    {
        $valor = str_replace('.','',$request->valor);
        $valor = str_replace(',','.',$valor);

        if($request->all()){
            Aporte::create([
                'data' => $request->data_aporte,
                'observacao' => $request->observacao_aporte,
                'valor' => $valor,
                'payment_methods_id' => $request->payments_methodcad,
            ]);

            return Redirect::route('aporte.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('aporte.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = Aporte::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Aporte $aporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAporteRequest  $request
     * @param  \App\Models\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAporteRequest $request, $id)
    {
        $item = Aporte::find($id);

        $valor = str_replace('.','',$request->valor);
        $valor = str_replace(',','.',$valor);

        if($item && $request->all()){
            $item->data = $request->data_aporte;
            $item->valor = $valor;
            $item->observacao = $request->observacao_aporte;
            $item->payment_methods_id = $request->payments_methodcad;      
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('aporte.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Aporte::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
