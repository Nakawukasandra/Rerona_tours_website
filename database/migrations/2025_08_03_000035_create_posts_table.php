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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('image')->nullable();
            $table->string('featured_image')->nullable(); // For hero images
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->json('tags')->nullable(); // For tourism tags like 'safari', 'wildlife', 'adventure'
            $table->integer('read_time')->nullable(); // Estimated reading time in minutes
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            // Indexes for better performance
            $table->index(['status', 'published_at']);
            $table->index('featured');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
