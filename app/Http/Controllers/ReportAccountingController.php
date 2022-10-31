<?php

namespace App\Http\Controllers;

use App\Models\Report_Accounting;
use App\Http\Requests\StoreReport_AccountingRequest;
use App\Http\Requests\UpdateReport_AccountingRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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


class ReportAccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $methods = Output::where('status', 'Paga')
        ->get();

        $total = Output::where('valor', '>', 0)
        ->where('status', 'Paga')
        ->get()
        ->sum
        ->valor;

        $mes = date("Y-m", strtotime("now"));
        

        return view('report_accounting', compact([
            'methods',
            'total',
            'mes'
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
     * @param  \App\Http\Requests\StoreReport_AccountingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReport_AccountingRequest $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report_Accounting  $report_Accounting
     * @return \Illuminate\Http\Response
     */
    public function show(Report_Accounting $report_Accounting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report_Accounting  $report_Accounting
     * @return \Illuminate\Http\Response
     */
    public function edit(Report_Accounting $report_Accounting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReport_AccountingRequest  $request
     * @param  \App\Models\Report_Accounting  $report_Accounting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReport_AccountingRequest $request, Report_Accounting $report_Accounting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report_Accounting  $report_Accounting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report_Accounting $report_Accounting)
    {
        //
    }
}
