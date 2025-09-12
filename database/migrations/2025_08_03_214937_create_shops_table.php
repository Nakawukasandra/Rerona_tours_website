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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('sku')->unique()->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->boolean('manage_stock')->default(true);
            $table->boolean('in_stock')->default(true);
            $table->string('status')->default('active'); // active, inactive, draft
            $table->json('images')->nullable(); // Store multiple images as JSON
            $table->string('featured_image')->nullable();
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable(); // e.g., "10x15x5 cm"
            $table->string('material')->nullable();
            $table->string('origin')->nullable(); // Country/region of origin
            $table->text('care_instructions')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_handmade')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('meta')->nullable(); // Additional metadata
            $table->timestamps();

            // Indexes for better performance
            $table->index(['status', 'is_featured']);
            $table->index(['category', 'status']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
