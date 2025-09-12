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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('duration_days')->default(1);
            $table->integer('duration_nights')->default(0);
            $table->integer('max_guests')->default(10);
            $table->integer('min_guests')->default(1);
            $table->string('difficulty_level')->default('easy'); // easy, moderate, challenging
            $table->json('inclusions')->nullable(); // What's included in the service
            $table->json('exclusions')->nullable(); // What's not included
            $table->json('itinerary')->nullable(); // Day by day itinerary
            $table->json('gallery')->nullable(); // Array of image URLs
            $table->string('featured_image')->nullable();
            $table->string('category')->default('safari'); // safari, tour, accommodation, transport
            $table->json('locations')->nullable(); // Array of locations/destinations
            $table->string('pickup_location')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->time('pickup_time')->nullable();
            $table->time('dropoff_time')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('requirements')->nullable(); // What guests need to bring/prepare
            $table->text('cancellation_policy')->nullable();
            $table->integer('sort_order')->default(0);
            $table->json('meta_data')->nullable(); // For SEO and additional data
            $table->timestamps();

            $table->index(['category', 'is_active']);
            $table->index(['is_featured', 'is_active']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
