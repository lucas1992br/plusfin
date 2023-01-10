<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use App\Models\Input;
use App\Models\Origin;

use App\Models\Output;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\InputOrigin;
use App\Models\InputPayment;

use App\Models\InputReceipt;
use App\Models\PayingSource;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\StoreInputRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateInputRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $endDateMonth=Carbon::now()->endOfMonth()->toDateString();
        $firstDateMonth=Carbon::now()->startOfMonth()->toDateString();

        $methods = Input::where('data','>=',$firstDateMonth)->where('data','<',$endDateMonth)->get();

        $origins = Origin::where('status','Ativo')->where('tipo','Entrada')->get();
        $payments_methods = PaymentMethod::where('status','Ativo')->where('tipo','Entrada')->orderBy('id', 'DESC')->get();
        $payings_sources = PayingSource::all('nome', 'id');

        if($request->data_inicial_search && $request->data_final_search){

            $data_inicio = $request->data_inicial_search;
            $data_fim    = $request->data_final_search;

            $methods = Input::where('data', '>=', $data_inicio)->where('data', '<=', $data_fim)->get();
        }


        return view('input', compact([
            'methods',
            'origins',
            'payments_methods',
            'payings_sources',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $banco = str_replace('.','',$request->banco);
        $banco = str_replace(',','.',$banco);

        if($request->all()){
            Input::create([
                'status' =>$request->status = 'Entrada Efetuada',
                'data' => $request->data,
                'valor_payment7' => $banco,
                'valor_payment_total' => $banco,
            ]);
            return Redirect::route('entradas.index');
        }
        else
        {
            return Redirect::route('entradas.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInputRequest $request)
    {
        $input = new Input();
        $input->data = $request->data;
        $input->status = 'Entrada Pendente';
        $input->save();

        return $input->id;

        //return Redirect::route('entradas.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showItem = Input::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function edit(Input $input)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInputRequest  $request
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInputRequest $request)
    {
        $cont=count($request->origins);
        $data=$request->all();
        $inputId=$request->id_input_update;

        $input = Input::where('id','=',$inputId)->first();

        if (isset($input)){
            DB::beginTransaction();
            try{

                InputReceipt::where('input_id','=',$inputId)->delete();
                InputPayment::where('input_id','=',$inputId)->delete();

                $input->data = $data['data-update'];
                $input->save();
                $contadorOrigem=0;

                foreach ($data['origin_valor'] as $key => $value){

                    $origin_valor = str_replace('.','',$data['origin_valor'][$key]);
                    $origin_valor = str_replace(',','.',$origin_valor);

                    $payment_valor = str_replace('.','',$data['payment_valor'][$key]);
                    $payment_valor = str_replace(',','.',$payment_valor);

                    $inputReceipt = new InputReceipt();
                    $inputReceipt->input_id = $input->id;
                    $inputReceipt->origin_id = $data['origins'][$key];
                    $inputReceipt->payment_method_id = intval($data['payment_methods'][$key]);
                    $inputReceipt->origin_valor = $origin_valor;
                    $inputReceipt->save();

                    $inputPayment = new InputPayment();
                    $inputPayment->input_id = $input->id;
                    $inputPayment->payment_methods_id = $data['payment_methods'][$key];
                    $inputPayment->payment_valor = $payment_valor;
                    $inputPayment->save();
                }

                DB::commit();
                return response()->json([
                    'success' => 'true',
                    'msg'  => 'Entrada atualizada com sucesso',
                ], 200);
            }catch (Exception $e){
                DB::rollBack();
                return response()->json([
                    'success' => 'false',
                    'errors'  => $e->getMessage(),
                ], 400);
            }
        }else{
            return response()->json([
                'success' => 'false',
                'errors'  => 'Entrada não encontrada.',
            ], 404);
        }

    }

    public function detalhes(UpdateInputRequest $request)
    {

        $cont=count($request->origins);

        $data=$request->all();

        DB::beginTransaction();

        try{

            $input = new Input();
            $input->data = $data['data'];
            $input->status = 'Entrada Pendente';
            $input->save();

            for ($i=0;$i<$cont;$i++){

                $origin_valor = str_replace('.','',$data['origin_valor'][$i]);
                $origin_valor = str_replace(',','.',$origin_valor);

                $payment_valor = str_replace('.','',$data['payment_valor'][$i]);
                $payment_valor = str_replace(',','.',$payment_valor);

                $inputReceipt = new InputReceipt();
                $inputReceipt->input_id = $input->id;
                $inputReceipt->origin_id = $data['origins'][$i];
                $inputReceipt->payment_method_id = intval($data['payment_methods'][$i]);
                $inputReceipt->origin_valor = $origin_valor;
                $inputReceipt->save();

                $inputPayment = new InputPayment();
                $inputPayment->input_id = $input->id;
                $inputPayment->payment_methods_id = $data['payment_methods'][$i];
                $inputPayment->payment_valor = $payment_valor;
                $inputPayment->save();
            }

            DB::commit();
            return response()->json([
                'success' => 'true',
                'msg'  => 'Entrada efetuada com sucesso',
            ], 200);
        }catch (Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }

    }

    public function information(Request $request)
    {



        DB::beginTransaction();

        try{
            $inputInfo=Input::where('id','=',$request->inputId)->first();

            $inputs=InputReceipt::where('input_id','=',$request->inputId)->get();
            $origins = Origin::where('status','Ativo')->where('tipo','Entrada')->get();
            $payment_methods = PaymentMethod::where('status','Ativo')->where('tipo','Entrada')->orderBy('id', 'DESC')->get();
            if (count($inputs)>0){

                return  response()->json([
                    'info' => json_encode($inputInfo),
                    'inputs' => json_encode($inputs),
                    'payment_methods' => json_encode($payment_methods),
                    'origins' => json_encode($origins),
                    'msg'  => 'Entrada efetuada com sucesso',
                ], 200);

            }else{
                dd('count menor 0');
                response()->json([
                    'msg' => 'Entradas não encontradas.',
                    'erro'  => 'Nenhuma entrada no banco de dados',
                ], 404);
            }

        }catch (Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $item = Input::find($id);
            $item->receipts()->delete();
            $item->payments()->delete();
            $item->delete();
            DB::commit();
            return response()->json([
                'success' => 'true',
                'msg'  =>'Deletado com sucesso.',
            ], 200);
        }catch (Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }

    }
}
