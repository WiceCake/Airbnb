<?php

namespace App\Http\Controllers\Api\v1;

use DateTime;
use App\Models\Guest;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Discount;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    //

    public function makeBooking(Request $request, $id)
    {
        $validate = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'amount' => 'required|numeric',
            'created_at' => 'required'
        ]);

        $getDates = Booking::where('property_booked', $request->property_id)
            ->select('check_in_date', 'check_out_date')->get();

        foreach ($getDates as $date) {
            if (
                $request->checkin_date >= $date->check_in_date &&
                $request->checkin_date <= $date->check_out_date
            ) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'The property is not available on the provided dates'
                ]);
            }else if(
                $request->checkout_date >= $date->check_in_date &&
                $request->checkout_date <= $date->check_out_date
            ){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'The property is not available on the provided dates'
                ], 400);
            }
        }

        $checkin_date = new DateTime($request->checkin_date);
        $created_date = new DateTime($request->created_date);

        if($checkin_date->diff($created_date)->days < 3){
            return response()->json([
                'status' => 'invalid',
                'message' => 'You are required to make a reservation at least three days before check-in date.'
            ], 400);
        }

        $discount = Discount::where('name', $request->discount['name'])->first();

        Booking::create([
            'guest_id' => $id,
            'booking_date' => $request->created_at,
            'property_booked' => $request->property_id,
            'check_in_date' => $request->checkin_date,
            'check_out_date' => $request->checkout_date,
            'price' => $request->amount,
            'discount' => $discount ? $discount->id : 4,
        ]);

        return response()->json([
            'status' => 'success',
        ], 200);;
    }

    public function showProfile()
    {
        $guest = Guest::whereHas('getRememberToken', function ($q) {
            $q->where('token', request()->bearerToken());
        })->first();

        return $guest;
    }

    
    public function show($id){
        // $user = Guest::whereHas('getRememberToken', function($q){
        //     return $q->where('token', request()->bearerToken());
        // })->first();

        $reservations = Booking::where('guest_id', $id)->get();

        return response()->json([
            'reservations' => $reservations->map(function ($reservation) {
                return [
                    'id' => $reservation->id,
                    'property' => [
                        'slug' => $reservation->property->slug,
                        'title' => $reservation->property->property_title,
                        'province' => $reservation->property->address->first()->province,
                        'owner' => $reservation->property->owner->fullname
                    ],
                    'booking_date' => $reservation->booking_date,
                    'checkin_date' => $reservation->check_in_date,
                    'checkout_date' => $reservation->check_out_date,
                    'amount' => $reservation->price,
                    'cancellation_policy' => $reservation->property->policy->first()->name
                ];
            }),
            'count' => $reservations->count()
        ]);

    }

    public function review(Request $request, $id){
        $validate = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'required',
            'created_at' => 'required|date'
        ]);

        Review::create([
            'user_id' => $id,
            'property_id' => $request->property_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'created_at' => $request->created_at
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

}
