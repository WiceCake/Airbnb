<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->references('id')->on('guests');
            $table->timestamp('booking_date');
            $table->foreignId('property_booked')->references('id')->on('properties');
            $table->timestamp('check_in_date');
            $table->timestamp('check_out_date');
            $table->double('price');
            $table->foreignId('discount')->references('id')->on('discounts');
            $table->boolean('isCancelled')->nullable();
            $table->timestamp('dateCancelled')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
