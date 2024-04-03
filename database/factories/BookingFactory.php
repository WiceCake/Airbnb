<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\Guest;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guests = Guest::all()->pluck('id')->random();
        $properties = Property::all()->pluck('id')->random();
        $property = Property::find($properties)->first();
        $years = rand(1,5);

        return [
            'guest_id' => $guests,
            'booking_date' => now(),
            'property_booked' => $properties,
            'check_in_date' => now()->addYears($years),
            'check_out_date' => now()->addYears($years)->addDay(rand(1,28)),
            'discount' => 4,
            'price' => $property->price
        ];
    }
}
