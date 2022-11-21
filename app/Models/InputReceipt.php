<?php

namespace App\Models;
use App\Models\Input;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputReceipt extends Model
{
    use HasFactory;
    protected $table = 'input_receipt';
    protected $fillable = [
        'origin_id',
        'origin_valor'
    ];

    protected $with = ['origin','receipts'];
    public function receipts() {
        return $this->belongsTo(Input::class);
    }
    public function origin() {
        return $this->hasOne(Origin::class , 'id', 'origin_id');
    }
}
