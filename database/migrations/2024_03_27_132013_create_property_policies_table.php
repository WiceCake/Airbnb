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
        Schema::create('property_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->references('id')->on('properties');
            $table->foreignId('policy_id')->references('id')->on('cancellation_policies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_policies');
    }
};
