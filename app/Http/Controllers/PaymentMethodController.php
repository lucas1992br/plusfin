<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\PaymentMethod;
use App\Models\Activity;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $methods = PaymentMethod::all();
        $activities = Activity::all('nome', 'id');

        return view('payment-method', compact([
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
     * @param  \App\Http\Requests\StorePaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethodRequest $request) {
        if($request->all()){
            PaymentMethod::create([
                'nome' => $request->nome,
                'tipo' => $request->tipo,
                'status' => $request->status,
                'activity_id' => $request->atividade,
            ]);
            // toDo: flash message de sucesso
            return Redirect::route('forma-pagamento.index');
        }else{
            // toDo: flash message de erro
            return Redirect::route('forma-pagamento.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $showItem = PaymentMethod::find($id);

        return response()->json($showItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentMethodRequest  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodRequest $request, $id) {
        $item = PaymentMethod::find($id);
        if($item && $request->all()){
            $item->nome = $request->nome;
            $item->tipo = $request->tipo;
            $item->status = $request->status;
            $item->activity_id = $request->atividade;
            $item->save();
            // toDo: flash message de sucesso
            return Redirect::route('forma-pagamento.index');
        }else{
            // toDo: flash message de erro
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $item = PaymentMethod::find($id);
        $item->delete();

        return response('Deletado com sucesso.', 200);
    }
}
