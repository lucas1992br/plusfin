<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Origin;
use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\PaymentMethod;
use App\Models\PayingSource;

class Input extends Model
{
    //use HasFactory;

    
    protected $fillable = [
        'status',
        'data',
        'observacao',
        'observacao_atuditoria',
        'observacao2',
        'observacao_atuditoria2',
        'payment_methods_id',
        'payment_methods_id2',
        'payment_methods_id3',
        'payment_methods_id4',
        'payment_methods_id5',
        'payment_methods_id6',
        'payment_methods_id7',
        'payment_methods_id8',
        'payment_methods_id9',
        'valor_payment',
        'valor_payment2',
        'valor_payment3',
        'valor_payment4',
        'valor_payment5',
        'valor_payment6',
        'valor_payment7',
        'valor_payment8',
        'valor_payment9',
        'valor_payment_total',
        'origin_id',
        'origin_id2',
        'origin_id3',
        'origin_id4',
        'origin_id5',
        'valor_origin',
        'valor_origin2',
        'valor_origin3',
        'valor_origin4',
        'valor_origin5',
        'valor_payment_origin'
    ];

    protected $with = ['activity', 'origin', 'payments_methods', 'payings_sources', 'payments_methods2'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }

    public function origin() {
        return $this->hasOne(Origin::class , 'id', 'origin_id');
    }

    public function payments_methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }

    public function payments_methods2() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }

    public function payings_sources() {
        return $this->hasOne(PayingSource::class  , 'id', 'paying_sources_id');
    }
 

}
