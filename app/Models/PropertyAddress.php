<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'address_id'
    ];
}
