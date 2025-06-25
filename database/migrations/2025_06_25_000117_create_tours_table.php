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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->integer('duration'); // number of days
            $table->integer('max_group_size')->default(10);
            $table->enum('difficulty_level', ['easy', 'moderate', 'challenging'])->default('easy');
            $table->enum('tour_type', ['gorilla_trekking', 'wildlife_safari', 'cultural', 'adventure', 'birding', 'combined'])->default('wildlife_safari');

            // For "Any Month" dropdown
            $table->json('available_months'); // ["January", "February", "March", etc.]

            // For "Sort By Date" functionality
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('departure_dates')->nullable(); // specific available dates

            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('itinerary')->nullable(); // day by day itinerary
            $table->json('includes')->nullable(); // what's included in price
            $table->json('excludes')->nullable(); // what's not included
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps(); // created_at for "Sort By Date"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
