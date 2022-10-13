<?php

namespace App\Http\Controllers;

use App\Models\Report_aporte;
use App\Http\Requests\StoreReport_aporteRequest;
use App\Http\Requests\UpdateReport_aporteRequest;
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
use App\Models\Retirada;
use App\Models\Aporte;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Report_aporteExport;

class ReportAporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          
        $methods = Aporte::all();
        $retirada = Retirada::all();

        $payments_methodcad = PaymentMethod::where('tipo','Saida')->where('status','Ativo')->get();
        $somatoria = Aporte::where('valor','>', '0')->get()->sum->valor;
        if($request->data_inicial_search && $request->data_final_search){

            $data_inicio = $request->data_inicial_search;
            $data_fim    = $request->data_final_search;

            $methods = Aporte::whereDate('data', '>=', $data_inicio)->whereDate('data', '<=', $data_fim)->get();
            $somatoria = Aporte::where('valor','>', '0')->whereDate('data', '>=', $data_inicio)->whereDate('data', '<=', $data_fim)->get()->sum->valor;         
        }        

        return view('report_aporte', compact([
            'methods',
            'retirada',
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
     * @param  \App\Http\Requests\StoreReport_aporteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReport_aporteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report_aporte  $report_aporte
     * @return \Illuminate\Http\Response
     */
    public function show(Report_aporte $report_aporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report_aporte  $report_aporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Report_aporte $report_aporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReport_aporteRequest  $request
     * @param  \App\Models\Report_aporte  $report_aporte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReport_aporteRequest $request, Report_aporte $report_aporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report_aporte  $report_aporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report_aporte $report_aporte)
    {
        //
    }
    public function export()  {
        return Excel::download(new Report_aporteExport, "RepatorioAporte_" . now() . ".xlsx");
    }
}
