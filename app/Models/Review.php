<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'property_id', 'rating', 'review', 'created_at'
    ];

    function getUser(){
        return $this->belongsTo(Guest::class, 'user_id');
    }
}
