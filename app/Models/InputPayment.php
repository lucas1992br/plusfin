<?php

namespace App\Models;
use App\Models\Input;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InputPayment extends Model
{
    protected $table = 'input_payment';
    
    protected $fillable = [
        'payment_methods_id',
        'payment_valor'
    ];

    protected $with = ['payments', 'payments_methods'];

    public function payments() {
        return $this->belongsTo(Input::class);
    }
    public function payments_methods() {
        return $this->hasOne(PaymentMethod::class , 'id', 'payment_methods_id');
    }
}
