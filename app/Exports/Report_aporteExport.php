<?php

namespace App\Exports;

use App\Models\Report_aporte;
use App\Models\Aporte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Report_aporteExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('reports.report_aporte', [
            'methods' => Aporte::all(),
            'somatoria' => Aporte::where('valor','>', '0')->get()->sum->valor,
        ]);
    }
}                            
                                                                                