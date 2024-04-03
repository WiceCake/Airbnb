<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Guest;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CancellationBooking;
use DateTime;

class ReviewController extends Controller
{
    //
    public function cancel($id){
        $user = Guest::whereHas('getRememberToken', function($q){
            return $q->where('token', request()->bearerToken());
        })->first();

        $booking = Booking::where(['guest_id' => $user->id, 'id' => $id])->first();

        if($booking){
            if($booking->isCancelled)
            return response()->json([
                'status' => 'invalid',
                'message' => 'This booking is already cancelled'
            ], 401);
        }

        if(!$booking){
            return response()->json([
                'status' => 'invalid',
                'message' => 'You are not the owner of this booking or the booking does not exist'
            ], 403);
        }

        $checkIn = new DateTime($booking->check_in_date);
        $dateCancel = new DateTime(now());

        // return $booking;

        if(date_diff($dateCancel, $checkIn)->invert){
            return response()->json([
                'status' => 'invalid',
                'message' => 'This booking is already past date'
            ], 401);
        }

        $policy = $booking->property->policy->first();

        $refund = $policy->refunds->first()->id;

        if($policy->name == 'moderate' || $policy->name == 'strict'){
            $days = $policy->refunds->pluck('days');
            $daysLeft = date_diff($dateCancel, $checkIn)->days;

            if ($daysLeft >= $days[0]) $refund = $policy->refunds->get(0)->id;
            else if ($daysLeft >= $days[1]) $refund = $policy->refunds->get(1)->id;
            else if ($daysLeft >= $days[2]) $refund = $policy->refunds->get(2)->id;
            else 
            return response()->json([
                'status' => 'invalid',
                'message' => 'This booking cannot be cancelled'
            ], 401);
        }
        
        $booking->isCancelled = true;
        $booking->dateCancelled = now();
        $booking->save();

        CancellationBooking::create([
            'booking_id' => $booking->id,
            'refund_id' => $refund
        ]);

        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
