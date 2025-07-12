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
        Schema::create('tour_destinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('destination_id');
            $table->integer('visit_order');
            $table->integer('days_spent');
            $table->text('activities')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');

            // Add unique constraint to prevent duplicate tour-destination pairs
            $table->unique(['tour_id', 'destination_id']);

            // Add index for visit_order for better performance when ordering
            $table->index(['tour_id', 'visit_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_destinations');
    }
};
