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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->references('id')->on('managers');
            $table->string('property_title');
            $table->text('description');
            $table->string('slug');
            $table->integer('capacity');
            $table->integer('no_of_beds');
            $table->integer('no_of_bedrooms');
            $table->integer('no_of_bathrooms');
            $table->double('price');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
