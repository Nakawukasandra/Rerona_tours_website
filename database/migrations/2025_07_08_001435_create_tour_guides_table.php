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
        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id('guide_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('bio')->nullable();
            $table->string('language');
            $table->decimal('rating', 3, 2)->default(0.00); // Rating out of 5.00
            $table->integer('years_experience');
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            // Add indexes for better performance
            $table->index('email');
            $table->index('is_available');
            $table->index('rating');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guides');
    }
};
