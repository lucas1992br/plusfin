<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;

class Output extends Model
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

    protected $with = ['activity', 'origin', 'payments_methods', 'payings_sources'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }

    public function origin() {
        return $this->hasOne(Origin::class , 'id', 'origin_id');
    }

    public function payments_methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }

    public function payings_sources() {
        return $this->hasOne(PayingSource::class  , 'id', 'paying_sources_id');
    }
}
