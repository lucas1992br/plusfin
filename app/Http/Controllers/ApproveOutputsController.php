<?php

namespace App\Http\Controllers;

use App\Models\ApproveOutputs;
use App\Http\Requests\StoreApproveOutputsRequest;
use App\Http\Requests\UpdateApproveOutputsRequest;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;

class ApproveOutputsController extends Controller
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

        return view('approveoutputs', compact([
            'methods',
            'activities',
            'origins',
            'payings_sources' ,
            'payments_methods'
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
     * @param  \App\Http\Requests\StoreApproveOutputsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApproveOutputsRequest $request)
    {
        if($request->all()){
            Output::create([
                'status' => $request->status,
                'data' => $request->data,
                'conta' => $request->conta,
                'observacao' => $request->observacao,
                'observacao_atuditoria' => $request->observacao_atuditoria,
                'observacao2' => $request->observacao2,
                'observacao_atuditoria2' => $request->observacao_atuditoria2,
                'valor' => $request->valor,
                'paying_sources_id' => $request->paying_sources_id,
                'payment_methods_id' => $request->payment_methods_id,
                'origin_id' => $request->origin_id,
            ]);

            return Redirect::route('aprovar-saidas.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('aprovar-saidas.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApproveOutputs  $approveOutputs
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
     * @param  \App\Models\ApproveOutputs  $approveOutputs
     * @return \Illuminate\Http\Response
     */
    public function edit(ApproveOutputs $approveOutputs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApproveOutputsRequest  $request
     * @param  \App\Models\ApproveOutputs  $approveOutputs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApproveOutputsRequest $request, $id)
    {
        $item = Output::find($id);
        if($item && $request->all()){
            $item->status = $request->status;
            $item->data = $request->data;
            $item->conta = $request->conta;
            $item->observacao = $request->observacao;
            $item->observacao2 = $request->observacao2;
            $item->observacao_atuditoria = $request->observacao_atuditoria;
            $item->observacao_atuditoria2 = $request->observacao_atuditoria2;
            $item->valor = $request->valor;
            $item->paying_sources_id = $request->paying_sources_id;
            $item->payment_methods_id = $request->payment_methods_id;
            $item->origin_id = $request->origin_id;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('aprovar-saidas.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApproveOutputs  $approveOutputs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Output::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
