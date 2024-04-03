<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();    

        $bookings = Booking::orderBy('booking_date', 'desc')
        ->whereHas('property', function ($query) use ($user){
            return $query->where('manager_id', $user->id);
        });
        
        $bookingParam = $request->bookings ? $request->bookings : '';


        if($request->property){
            $bookings = $bookings->where('property_booked', $request->property);
        }

        if($bookingParam == 'pb'){
            $bookings = $bookings->where('check_out_date', '<', now());
        }

        if($bookingParam == 'ub'){
            $bookings = $bookings->where('check_in_date', '>', now())
            ->where('isCancelled', null);
        }

        if($bookingParam == 'cb'){
            $bookings = $bookings->where('isCancelled', 1);
        }

        // dd($bookings);

        $bookings = $bookings->paginate(10);
        
        $properties = Booking::all()->unique('property_booked');

        return view('bookings')->with(compact('bookings', 'properties'));
    }
}
