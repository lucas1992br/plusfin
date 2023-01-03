<?php

namespace App\Models;

use App\Models\Filein;
use App\Models\Origin;

use App\Models\Activity;
use App\Models\CostCenter;
use App\Models\InputReceipt;
use App\Models\PayingSource;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


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
        'valor_payment_id',
        'valor_payment_total',
        'origin_id',
        'valor_origin'
    ];

    protected $with = ['activity', 'origin', 'payments_methods', 'payings_sources', 'files', 'receipts', 'payments'];

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }

    public function origin() {
        return $this->hasOne(Origin::class , 'id', 'origin_id');
    }

    public function originById($idOrigin) {

        $outputPayment=DB::select("SELECT origin_valor as valor FROM plusfin_db.input_receipt where input_id="
            .$this->id." and origin_id=".$idOrigin);

        if(isset($outputPayment[0])){
            return $outputPayment[0]->valor;
        }else{
            return 0;
        }

    }

    public function paymentsById($idPayment) {

        $outputPayment=DB::select("SELECT payment_valor as valor FROM plusfin_db.input_payment where input_id="
            .$this->id." and payment_methods_id=".$idPayment);

        if(isset($outputPayment[0])){
            return $outputPayment[0]->valor;
        }else{
            return 0;
        }
    }

    public function totalValue(){
            return $this->receipts()->sum('origin_valor');
    }

    public function payments_methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }
    public function payings_sources() {
        return $this->hasOne(PayingSource::class  , 'id', 'paying_sources_id');
    }
    public function files() {
        return $this->belongsToMany(Filein::class);
    }

    public function receipts() {
        return $this->hasMany(InputReceipt::class);
    }

    public function payments() {
        return $this->hasMany(InputPayment::class);
    }


}
