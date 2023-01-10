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
        $valor=0;
        $originsValue=DB::select("SELECT origin_valor as valor FROM input_receipt where input_id="
            .$this->id." and origin_id=".$idOrigin);

        if(isset($originsValue)){
            foreach ($originsValue as $originValue){
                $valor+=$originValue->valor;
            }
            return $valor;
        }else{
            return 0;
        }

    }

    public function paymentsById($idPayment) {
        $valor=0;
        $outputPayments=DB::select("SELECT origin_valor as valor FROM input_receipt where input_id="
            .$this->id." and payment_method_id=".$idPayment);

        if(isset($outputPayments)){
            foreach ($outputPayments as $outputPayment){
                $valor+=$outputPayment->valor;
            }
            return $valor;
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
