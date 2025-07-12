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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('hotel_type');
            $table->text('address');
            $table->string('city');
            $table->string('country');
            $table->decimal('rating', 2, 1)->nullable();
            $table->text('amenities')->nullable();
            $table->text('contact_info')->nullable();
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
