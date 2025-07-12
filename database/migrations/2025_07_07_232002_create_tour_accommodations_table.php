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
        Schema::create('tour_accommodations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('accommodation_id');
            $table->integer('night_count');
            $table->string('room_type');
            $table->decimal('cost_per_night', 10, 2);
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');

            // Add unique constraint to prevent duplicate tour-accommodation pairs
            $table->unique(['tour_id', 'accommodation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_accommodations');
    }
};
