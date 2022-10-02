<?php

namespace App\Http\Controllers;

use App\Models\OutgoingPayment;
use App\Http\Requests\StoreOutgoingPaymentRequest;
use App\Http\Requests\UpdateOutgoingPaymentRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;
use App\Models\File;
use Illuminate\Http\Request;

class OutgoingPaymentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $methods = Output::all();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');

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

        return view('outgoingpayment', compact([
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
     * @param  \App\Http\Requests\StoreOutgoingPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingPayment  $outgoingPayment
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingPayment $outgoingPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingPayment  $outgoingPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingPayment $outgoingPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingPaymentRequest  $request
     * @param  \App\Models\OutgoingPayment  $outgoingPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingPaymentRequest $request, $id) {
        $item = Output::find($id);
       
        if($item && $request->all()){
            if($request->hasfile('files') && $item->status === "Pagamento Pendente") {
                foreach($request->file('files') as $file) {
                    $path = $file->store('files');
                    $name = $file->getClientOriginalName();

                    $arquivo = File::create([
                        'name' => "$name-comprovante",
                        'path' => $path,
                    ]);

                    $item->files()->attach($arquivo);
                    $file->move(public_path().'/files/', $path);
                };
                $item->status = "Paga";
                $item->save();
            };

            return Redirect::route('saidas.index');
        }else{
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingPayment  $outgoingPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingPayment $outgoingPayment)
    {
        //
    }
}
