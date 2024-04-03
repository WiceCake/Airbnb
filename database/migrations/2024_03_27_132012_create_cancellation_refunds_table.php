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
        Schema::create('cancellation_refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->references('id')->on('cancellation_policies');
            $table->integer('days');
            $table->double('refund_percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellation_refunds');
    }
};
