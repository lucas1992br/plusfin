<?php

namespace App\Exports;

use App\Models\Report_aporte;
use App\Models\Aporte;
use Maatwebsite\Excel\Concerns\FromCollection;

class Report_aporteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aporte::all();
    }
}
