<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CostCenter;

class Activity extends Model
{
    // use HasFactory;
    protected $fillable = [
        'nome'
    ];

    public function costCenters() {
        return $this->hasMany(CostCenter::class , 'activity_id', 'id');
    }
}
