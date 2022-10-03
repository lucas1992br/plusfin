<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayingSourceRequest;
use App\Http\Requests\UpdatePayingSourceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\PayingSource;
use App\Models\Activity;

class PayingSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $methods = PayingSource::all();
        $activities = Activity::all('nome', 'id');

        if($request->tipo_search){
            $methods = PayingSource::where('tipo', $request->tipo_search)->get();
        }
        if($request->status_search){
            $methods = PayingSource::where('status', $request->status_search)->get();
        }
        if($request->atividade_search){
            $methods = PayingSource::where('activity_id', $request->atividade_search)->get();
        }

        return view('paying-source', compact([
            'methods',
            'activities'
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
     * @param  \App\Http\Requests\StorePayingSourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayingSourceRequest $request)
    {
        if($request->all()){
            PayingSource::create([
                'nome' => $request->nome,
                'tipo' => $request->tipo,
                'status' => $request->status,
                'activity_id' => $request->atividade,
            ]);
            // toDo: flash message de sucesso
            return Redirect::route('fonte-pagante.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('fonte-pagante.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayingSource  $payingSource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = PayingSource::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayingSource  $payingSource
     * @return \Illuminate\Http\Response
     */
    public function edit(PayingSource $payingSource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayingSourceRequest  $request
     * @param  \App\Models\PayingSource  $payingSource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayingSourceRequest $request, $id)
    {
        $item = PayingSource::find($id);
        if($item && $request->all()){
            $item->nome = $request->nome;
            $item->tipo = $request->tipo;
            $item->status = $request->status;
            $item->activity_id = $request->atividade;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('fonte-pagante.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayingSource  $payingSource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PayingSource::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
