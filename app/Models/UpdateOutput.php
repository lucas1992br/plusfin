<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;
use App\Models\Output;

class UpdateOutput extends Model
{
    

    //use HasFactory;
    protected $fillable = [
        'status',
        'data',
        'conta',
        'observacao',
        'observacao_atuditoria',
        'observacao2',
        'observacao_atuditoria2',
        'valor',
        'activity_id',
        'paying_sources_id',
        'payment_methods_id',
        'origin_id'
    ];

    protected $with = ['activity', 'costCenter', 'origin', 'Payments_Methods', 'Payings_Sources'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }

    public function costCenter() {
        return $this->hasOne(CostCenter::class , 'id', 'activity_id');
    }

    public function origin() {
        return $this->hasOne(Origin::class , 'id', 'activity_id');
    }

    public function Payments_Methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'activity_id');
    }

    public function Payings_Sources() {
        return $this->hasOne(PayingSource::class  , 'id', 'activity_id');
    }
}
