<?php

namespace App\Http\Controllers;

use App\Models\UploadDocument;
use App\Http\Requests\StoreUploadDocumentRequest;
use App\Http\Requests\UpdateUploadDocumentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;

class UploadDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Output::where('status', '=', 'Envio De Documentos Pendente')->get();            
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');
        return view('uploaddocument', compact([
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
     * @param  \App\Http\Requests\StoreUploadDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadDocumentRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function show(UploadDocument $uploadDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadDocument $uploadDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadDocumentRequest  $request
     * @param  \App\Models\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadDocumentRequest $request, UploadDocument $uploadDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadDocument $uploadDocument)
    {
        //
    }
}
