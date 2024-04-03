<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id', 'booking_date', 'property_booked',
        'check_in_date', 'check_out_date', 'price',
        'discount', 'isCancelled', 'dateCancelled'
    ];

    function property(){
        return $this->belongsTo(Property::class, 'property_booked');
    }

    function guest(){
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
