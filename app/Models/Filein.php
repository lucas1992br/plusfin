<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Filein extends Model
{
    //use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    public function inputs() {
        return $this->belongsToMany(Input::class);
    }
}
