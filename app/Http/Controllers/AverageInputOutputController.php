<?php

namespace App\Http\Controllers;
use App\Models\Input;
use App\Models\Output;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Average_input_output;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAverage_input_outputRequest;
use App\Http\Requests\UpdateAverage_input_outputRequest;

class AverageInputOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->data_inicial_search && $request->data_final_search && $contas_pagas = $request->contas_pagas && $entradas_efetivadas = $request->entradas_efetivadas){

            $data_inicio = $request->data_inicial_search;
            $data_fim = $request->data_final_search;
            $contas_pagas = $request->contas_pagas;
            $entradas_efetivadas = $request->entradas_efetivadas;
            
        }
        $fontePagante = Output::select("paying_sources_id", DB::raw('SUM(valor) as Total'))
        ->groupBy('paying_sources_id')           
        ->get();

        $res = Input::select("inputs.data","input_receipt.origin_id",DB::raw("MONTH(inputs.data) as Mes"),DB::raw('SUM(input_receipt.origin_valor) as Total'))
        ->join('input_receipt', 'inputs.id', '=', 'input_receipt.input_id')
        ->where('status','Entrada Pendente')
        ->groupBy(\DB::raw('MONTH(inputs.data)'))           
        ->pluck('Mes','Total');
        
        $sumOrigin = [1 => 0, 
            2 => 0, 
            3 => 0, 
            4 => 0, 
            5 => 0, 
            6 => 0, 
            7 => 0, 
            8 => 0, 
            9 => 0, 
            10 => 0, 
            11 => 0, 
            12 => 0];

        foreach ( $res as $key => $value ){
            $sumOrigin[(int)$value] = (int)$key;
        }
       
        $methods = Output::all();
                          
        return view('relatorios.average_input_output', compact(['methods', 'fontePagante', 'sumOrigin'
            
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
     * @param  \App\Http\Requests\StoreAverage_input_outputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAverage_input_outputRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Average_input_output  $average_input_output
     * @return \Illuminate\Http\Response
     */
    public function show(Average_input_output $average_input_output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Average_input_output  $average_input_output
     * @return \Illuminate\Http\Response
     */
    public function edit(Average_input_output $average_input_output)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAverage_input_outputRequest  $request
     * @param  \App\Models\Average_input_output  $average_input_output
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAverage_input_outputRequest $request, Average_input_output $average_input_output)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Average_input_output  $average_input_output
     * @return \Illuminate\Http\Response
     */
    public function destroy(Average_input_output $average_input_output)
    {
        //
    }
}
