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
        Schema::create('tour_schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('tour_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('available_slots');
            $table->decimal('current_price', 10, 2);
            $table->enum('status', ['active', 'inactive', 'cancelled', 'completed'])->default('active');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');

            // Indexes for better performance
            $table->index('tour_id');
            $table->index('start_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_schedules');
    }
};
