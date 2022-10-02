<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\UpdateOutputRequest;

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

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

              
        $methods = Output::all();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');
        $payments_methodcad = PaymentMethod::where('tipo','Saida')->where('status','Ativo')->get();
        $payings_sourcecad = PayingSource::where('tipo','Saida')->where('status','Ativo')->get();;

        if($request->status){
            $methods = Output::where('status', $request->status)->get();
        }
        if($request->data_inicial_search && $request->data_final_search){

            $data_inicio = $request->data_inicial_search;
            $data_fim    = $request->data_final_search;

            $methods = Output::whereDate('data', '>=', $data_inicio)->whereDate('data', '<=', $data_fim)->get();           
        }
        if($request->excluida_search){
            $methods = Output::where('status', $request->excluida_search)->get();
        }
        if($request->origin_search){
            $methods = Output::where('origin_id', $request->origin_search)->get();
        }
        if($request->payments_methods_search){
            $methods = Output::where('payment_methods_id', $request->payments_methods_search)->get();
        }
        if($request->paying_sources_search){
            $methods = Output::where('paying_sources_id', $request->paying_sources_search)->get();
        }
        
        return view('output', compact([
            'methods',
            'activities',
            'origins',
            'payings_sources' ,
            'payments_methods',
            'payments_methodcad',
            'payings_sourcecad'
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
     * @param  \App\Http\Requests\StoreOutputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutputRequest $request)
    {
        $valor = str_replace('.','',$request->valor);
        $valor = str_replace(',','.',$valor);

        if($request->all()){
            Output::create([
                'status' => $request->status,
                'data' => $request->data,
                'conta' => $request->conta,
                'observacao' => $request->observacao,
                'observacao_atuditoria' => $request->observacao_atuditoria,
                'observacao2' => $request->observacao2,
                'observacao_atuditoria2' => $request->observacao_atuditoria2,
                'valor' => $valor,
                'paying_sources_id' => $request->paying_sources_id,
                'payment_methods_id' => $request->payment_methods_id,
                'origin_id' => $request->origin_id,
            ]);

            return Redirect::route('saidas.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('saidas.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = Output::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function edit(Output $output)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutputRequest  $request
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutputRequest $request, $id)
    {
        $item = Output::find($id);

        $valor = str_replace('.','',$request->valor);
        $valor = str_replace(',','.',$valor);

        if($item && $request->all()){
            $item->status = $request->status;
            $item->data = $request->data;
            $item->conta = $request->conta;
            $item->observacao = $request->observacao;
            $item->observacao2 = $request->observacao2;
            $item->observacao_atuditoria = $request->observacao_atuditoria;
            $item->observacao_atuditoria2 = $request->observacao_atuditoria2;
            $item->valor =  $valor;
            $item->paying_sources_id = $request->paying_sources_id;
            $item->payment_methods_id = $request->payment_methods_id;
            $item->origin_id = $request->origin_id;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('saidas.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Output::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);

    }
}
