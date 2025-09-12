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
         Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->enum('inquiry_type', ['general', 'booking', 'safari', 'tour', 'support'])->default('general');
            $table->enum('status', ['new', 'read', 'replied', 'resolved'])->default('new');
            $table->string('preferred_contact_method')->nullable();
            $table->date('preferred_travel_date')->nullable();
            $table->integer('number_of_travelers')->nullable();
            $table->decimal('budget_range', 10, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['status', 'created_at']);
            $table->index('inquiry_type');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
