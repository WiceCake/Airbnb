<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationPolicy extends Model
{
    use HasFactory;

    function refunds(){
        return $this->hasMany(CancellationRefund::class, 'policy_id');
    }
}