<?php

namespace App\Exports;

use App\Models\CostCenter;
use Maatwebsite\Excel\Concerns\FromCollection;

class CostCenterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CostCenter::all();
    }
}
