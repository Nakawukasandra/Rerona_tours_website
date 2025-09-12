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
         Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable(); // For guest users
            $table->unsignedBigInteger('user_id')->nullable(); // For authenticated users
            $table->unsignedBigInteger('product_id'); // Reference to tours/products
            $table->string('product_type')->default('tour'); // tour, package, etc.
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->integer('no_of_people')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->date('tour_date')->nullable();
            $table->json('additional_options')->nullable(); // For storing extra services, special requests
            $table->enum('status', ['active', 'ordered', 'expired'])->default('active');
            $table->timestamps();

            // Indexes
            $table->index(['session_id']);
            $table->index(['user_id']);
            $table->index(['product_id']);
            $table->index(['status']);

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
