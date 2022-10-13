<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public function activity() {
        return $this->hasOne(Activity::class , 'id', 'activity_id');
    }
}
