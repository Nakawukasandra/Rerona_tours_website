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
         Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->longText('description');
            $table->longText('mission')->nullable();
            $table->longText('vision')->nullable();
            $table->json('values')->nullable(); // Store company values as JSON array
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable(); // Store multiple images as JSON array
            $table->integer('years_experience')->nullable();
            $table->integer('happy_clients')->nullable();
            $table->integer('tours_completed')->nullable();
            $table->integer('destinations')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('social_media')->nullable(); // Store social media links as JSON
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
