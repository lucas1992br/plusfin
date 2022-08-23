<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\CostCenter;

class Origin extends Model
{
    //use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'status',
        'activity_id',
        'costcenter_id'
    ];

    protected $with = ['activity', 'costCenter'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }

    public function costCenter() {
        return $this->hasOne(CostCenter::class , 'id', 'costcenter_id');
    }
   
}
