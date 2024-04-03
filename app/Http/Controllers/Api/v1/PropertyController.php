<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->page ? $request->page : 0;
        $size = $request->size ? $request->size : 10;

        $properties = Property::skip($page * $size)->take($size)->get();

        if ($request->province) {
            $province = strtolower($request->province);
            $properties = Property::whereHas('address', function ($q) use ($province) {
                return $q->where('province', $province);
            })
                ->skip($page * $size)->take($size)->get();
        }

        if ($request->type) {
            $type = strtolower($request->type);
            $properties = Property::whereHas('type', function ($q) use ($type) {
                return $q->where('name', $type);
            })
                ->skip($page * $size)->take($size)->get();
        }

        if ($request->minPrice) {
            $price = $request->minPrice;
            $properties = Property::where('price', '>=', $price)
                ->skip($page * $size)->take($size)->get();
        }

        if ($request->maxPrice) {
            $price = $request->maxPrice;
            $properties = Property::where('price', '<=', $price)
                ->skip($page * $size)->take($size)->get();
        }

        if ($request->bedrooms) {
            $bedrooms = $request->bedrooms;
            $properties = Property::where('no_of_bedrooms', '=', $bedrooms)
                ->skip($page * $size)->take($size)->get();
        }

        return response()->json([
            'listings' => $properties->map(function ($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->property_title,
                    'slug' => $property->slug,
                    'type' => $property->type->first()->name,
                    'owner' =>
                    $property->owner->first()->first_name . ' ' .
                        $property->owner->first()->last_name,
                    'capacity' => $property->capacity,
                    'beds' => $property->no_of_beds,
                    'bedrooms' => $property->no_of_bedrooms,
                    'bathrooms' => $property->no_of_bathrooms,
                    'address' => [
                        'province' => ucfirst($property->address->first()->province),
                        'municipality' => ucfirst($property->address->first()->municipality),
                        'barangay' => ucfirst($property->address->first()->barangay),
                    ],
                    'description' => $property->description,
                    'amenities' => $property->amenities->pluck('name'),
                    'pictures' => $property->pictures->pluck('path'),
                    'price' => $property->price,
                    'cancellation_policty' => $property->policy->first()->name,
                    'discounts' => $property->discounts->map(function ($discount) {
                        return [
                            'name' => $discount->discountDetail->first()->name,
                            'percent_discount' => $discount->changed_value * 100
                        ];
                    }),
                    'status' => $property->status,
                    'avg_rating' => 0,
                    'reviews' => [],
                    'created_at' => $property->created_at->format('Y-m-d H:i:s')
                ];
            })
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->first();

        return response()->json([
            'id' => $property->id,
            'title' => $property->property_title,
            'slug' => $property->slug,
            'type' => $property->type->first()->name,
            'owner' =>
            $property->owner->first()->first_name . ' ' .
                $property->owner->first()->last_name,
            'capacity' => $property->capacity,
            'beds' => $property->no_of_beds,
            'bedrooms' => $property->no_of_bedrooms,
            'bathrooms' => $property->no_of_bathrooms,
            'address' => [
                'province' => ucfirst($property->address->first()->province),
                'municipality' => ucfirst($property->address->first()->municipality),
                'barangay' => ucfirst($property->address->first()->barangay),
            ],
            'description' => $property->description,
            'amenities' => $property->amenities->pluck('name'),
            'pictures' => $property->pictures->pluck('path'),
            'price' => $property->price,
            'cancellation_policty' => $property->policy->first()->name,
            'discounts' => $property->discounts->map(function ($discount) {
                return [
                    'name' => $discount->discountDetail->first()->name,
                    'percent_discount' => $discount->changed_value * 100
                ];
            }),
            'status' => $property->status,
            'avg_rating' => 0,
            'reviews' => [],
            'created_at' => $property->created_at->format('Y-m-d H:i:s')
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
