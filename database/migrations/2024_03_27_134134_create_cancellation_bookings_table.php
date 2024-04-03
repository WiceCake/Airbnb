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
        Schema::create('cancellation_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('refund_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('refund_id')->references('id')->on('cancellation_refunds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellation_bookings');
    }
};
