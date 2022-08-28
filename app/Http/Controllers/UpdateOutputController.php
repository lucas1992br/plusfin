<?php

namespace App\Http\Controllers;

use App\Models\UpdateOutput;
use App\Http\Requests\StoreUpdateOutputRequest;
use App\Http\Requests\UpdateUpdateOutputRequest;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;

class UpdateOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Output::where('status', '=', 'Atualização Pendente')->get();            
        $activities = Activity::all('nome', 'id');
        $costcenters = CostCenter::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');

        return view('updateoutput', compact([
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
     * @param  \App\Http\Requests\StoreUpdateOutputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOutputRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gerenciamento\UpdateOutput  $updateOutput
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
     * @param  \App\Models\gerenciamento\UpdateOutput  $updateOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateOutput $updateOutput, $id)
    {
        olá;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUpdateOutputRequest  $request
     * @param  \App\Models\gerenciamento\UpdateOutput  $updateOutput
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUpdateOutputRequest $request, $id)
    {  
        $item = UpdateOutput::find($id);
        if($item && $request->all()){
            $item->status = ('Aprovação Pendente');
            $item->data = $request->data;
            $item->conta = $request->conta;
            $item->valor = $request->valor;
            $item->paying_sources_id = $request->paying_sources_id;
            $item->payment_methods_id = $request->payment_methods_id;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('atualizar-saidas.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gerenciamento\UpdateOutput  $updateOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Output::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
