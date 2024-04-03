<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'discount_id',
        'changed_value'
    ];

    function discountDetail(){
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
