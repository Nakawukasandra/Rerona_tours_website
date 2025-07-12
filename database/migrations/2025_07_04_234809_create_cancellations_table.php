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
       Schema::create('cancellations', function (Blueprint $table) {
            $table->id('cancellation_id');
            $table->unsignedBigInteger('booking_id');
            $table->date('cancellation_date');
            $table->string('reason');
            $table->decimal('refund_amount', 10, 2)->default(0);
            $table->enum('refund_status', ['pending', 'processing', 'completed', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');

            // Indexes for better performance
            $table->index('booking_id');
            $table->index('cancellation_date');
            $table->index('refund_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellations');
    }
};
