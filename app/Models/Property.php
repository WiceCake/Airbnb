<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id','property_title', 'description', 'slug',
        'capacity', 'no_of_beds', 'no_of_bedrooms',
        'no_of_bathrooms', 'price', 'status'
    ];

    function owner(){
        return $this->belongsTo(Manager::class, 'manager_id');
    }

    function type(){
        return $this->belongsToMany(Type::class, 'property_types');
    }

    function address(){
        return $this->belongsToMany(Address::class, 'property_addresses');
    }

    function pictures(){
        return $this->hasMany(PropertyPicture::class, 'property')->latest();
    }

    function reviews(){
        return $this->hasMany(Review::class, 'property_id');
    }

    function discounts(){
        return $this->hasMany(PropertyDiscount::class, 'property_id');
    }

    function policy(){
        return $this->belongsToMany(CancellationPolicy::class, PropertyPolicy::class, 'property_id', 'policy_id');
    }

    function amenities(){
        return $this->belongsToMany(Amenity::class, PropertyAmenity::class);
    }

}
