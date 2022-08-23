<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;

class PaymentMethod extends Model
{
    //use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'status',
        'activity_id',
    ];

    protected $with = ['activity'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }
}
