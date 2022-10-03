<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOriginRequest;
use App\Http\Requests\UpdateOriginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $methods = Origin::all();            
        $activities = Activity::all('nome', 'id');
        $costcenters = CostCenter::all('nome', 'id');

        if($request->tipo_search){
            $methods = Origin::where('tipo', $request->tipo_search)->get();
        }
        if($request->status_search){
            $methods = Origin::where('status', $request->status_search)->get();
        }
        if($request->atividade_search){
            $methods = Origin::where('activity_id', $request->atividade_search)->get();
        }
        if($request->costcenter_search){
            $methods = Origin::where('costcenter_id', $request->costcenter_search)->get();
        }
        
        return view('origin', compact([
            'methods',
            'activities',
            'costcenters'
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
     * @param  \App\Http\Requests\StoreOriginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOriginRequest $request)
    {
            if($request->all()){
            Origin::create([
                'nome' => $request->nome,
                'tipo' => $request->tipo,
                'status' => $request->status,
                'costcenter_id' => $request->costcenter,
                'activity_id' => $request->atividade,
            ]);
            return Redirect::route('origem.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('origem.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = Origin::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function edit(Origin $origin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOriginRequest  $request
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOriginRequest $request, $id)
    {
        $item = Origin::find($id);
        if($item && $request->all()){
            $item->nome = $request->nome;
            $item->tipo = $request->tipo;
            $item->status = $request->status;
            $item->activity_id = $request->atividade;
            $item->costcenter_id = $request->costcenter;
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
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Origin::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
