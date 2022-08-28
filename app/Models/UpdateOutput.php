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
        'valor',
        'paying_sources_id',
        'payment_methods_id',
    ];

    protected $with = ['Payments_Methods', 'Payings_Sources'];

    public function Payments_Methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }

    public function Payings_Sources() {
        return $this->hasOne(PayingSource::class  , 'id', 'paying_sources_id');
    }
}
