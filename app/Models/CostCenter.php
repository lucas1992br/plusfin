<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;

class CostCenter extends Model
{
    // use HasFactory;
    protected $fillable = [
        'nome',
        'activity_id',
        'tipo',
    ];

    protected $with = ['activity'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }
}
