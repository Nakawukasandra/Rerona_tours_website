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
        Schema::create('tour_assignments', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('guide_id');
            $table->date('assignment_date');
            $table->text('note')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('schedule_id');
            $table->index('guide_id');
            $table->index('assignment_date');

            // Add unique constraint to prevent duplicate schedule-guide assignments on same date
            $table->unique(['schedule_id', 'guide_id', 'assignment_date'], 'tour_assignments_unique');
        });

        // Add foreign key constraints after table creation (if referenced tables exist)
        if (Schema::hasTable('schedules')) {
            Schema::table('tour_assignments', function (Blueprint $table) {
                $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            });
        }

        if (Schema::hasTable('tour_guides')) {
            Schema::table('tour_assignments', function (Blueprint $table) {
                $table->foreign('guide_id')->references('guide_id')->on('tour_guides')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_assignments');
    }
};
