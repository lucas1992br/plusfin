<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $activities = Activity::all();
        return view('activity', compact('activities'));
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
     * @param  \App\Http\Requests\StoreActivityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityRequest $request) {
        if($request->all()){
            Activity::create([
                'nome' => $request->nome,
                // 'atividade' => $request->atividade,
                // 'tipo' => $request->tipo,
            ]);
            // toDo: flash message de sucesso
            return Redirect::route('atividade.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('atividade.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $acitivity = Activity::find($id);

        return response()->json($acitivity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityRequest  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityRequest $request, $id) {
        $item = Activity::find($id);
        if($item && $request->all()){
            $item->nome = $request->nome;
            // $item->atividade = $request->atividade;
            // $item->tipo = $request->tipo;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('atividade.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $acitivity = Activity::find($id);
        $acitivity->delete();

        return response('Atividade removida com sucesso.', 200);
    }
}
