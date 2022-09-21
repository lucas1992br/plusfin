<?php

namespace App\Http\Controllers;

use App\Models\UploadDocumentInput;
use App\Http\Requests\StoreUploadDocumentInputRequest;
use App\Http\Requests\UpdateUploadDocumentInputRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;
use App\Models\Input;
use App\Models\Filein;

class UploadDocumentInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Input::where('status', '=', 'Entrada Pendente')->get();
        $activities = Activity::all('nome', 'id');
        $origins = Origin::all('nome', 'id');
        $payments_methods = PaymentMethod::all('nome', 'id');
        $payings_sources = PayingSource::all('nome', 'id');
        return view('inputdocument', compact([
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
     * @param  \App\Http\Requests\StoreUploadDocumentInputRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadDocumentInputRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadDocumentInput  $uploadDocumentInput
     * @return \Illuminate\Http\Response
     */
    public function show(UploadDocumentInput $uploadDocumentInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadDocumentInput  $uploadDocumentInput
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadDocumentInput $uploadDocumentInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadDocumentInputRequest  $request
     * @param  \App\Models\UploadDocumentInput  $uploadDocumentInput
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadDocumentInputRequest $request, $id)
    {
        $item = Input::find($id);

        if($item && $request->all()){
            if($request->hasfile('files') && $item->status === "Entrada Pendente") {
                foreach($request->file('files') as $file) {
                    $path = $file->store('files');
                    $name = $file->getClientOriginalName();

                    $arquivo = Filein::create([
                        'name' => $name,
                        'path' => $path,
                    ]);

                    $item->files()->attach($arquivo);
                    $file->move(public_path().'/files/', $path);
                };
                $item->status = "Entrada Efetuada";
                $item->save();
            };

            return Redirect::route('entradas.index');
        }else{
            return response('Houve um erro ao salvar.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadDocumentInput  $uploadDocumentInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadDocumentInput $uploadDocumentInput)
    {
        //
    }
}
