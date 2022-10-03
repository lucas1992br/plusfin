<?php

namespace App\Http\Controllers;

use App\Exports\CostCenterExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests\StoreCostCenterRequest;
use App\Http\Requests\UpdateCostCenterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\CostCenter;
use App\Models\Activity;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $cost_centers = CostCenter::all();
        $activities = Activity::all('nome', 'id');

        if($request->tipo_search){
            $cost_centers = CostCenter::where('tipo', $request->tipo_search)->get();
        }
        if($request->status_search){
            $cost_centers = CostCenter::where('atividade', $request->status_search)->get();
        }
        if($request->atividade_search){
            $cost_centers = CostCenter::where('tipo', $request->atividade_search)->get();
        }

        return view('cost-center', compact([
            'cost_centers',
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
     * @param  \App\Http\Requests\StoreCostCenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostCenterRequest $request) {
        if($request->all()){
            CostCenter::create([
                'nome' => $request->nome,
                'activity_id' => $request->atividade,
                'tipo' => $request->tipo,
            ]);
            // toDo: flash message de sucesso
            return Redirect::route('centro-de-custo.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('centro-de-custo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CostCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $costCenter = CostCenter::find($id);

        return response()->json($costCenter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CostCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(CostCenter $costCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCostCenterRequest  $request
     * @param  \App\Models\CostCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCostCenterRequest $request, $id) {
        $item = CostCenter::find($id);
        if($item && $request->all()){
            $item->nome = $request->nome;
            $item->activity_id = $request->atividade;
            $item->tipo = $request->tipo;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('centro-de-custo.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CostCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $costCenter = CostCenter::find($id);
        $costCenter->delete();

        return response('Deletado com sucesso.', 200);
    }

    public function export()  {
        return Excel::download(new CostCenterExport, "CentroDecusto_" . now() . ".xlsx");
    }
}
