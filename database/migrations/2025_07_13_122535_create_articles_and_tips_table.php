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
        Schema::create('articles_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt'); // Short summary for cards/listings
            $table->longText('content'); // Full article content
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable(); // Additional images
            $table->string('category')->default('article'); // article, tip, guide, news
            $table->json('tags')->nullable(); // Safari, Wildlife, Travel Tips, etc.
            $table->string('author')->nullable();
            $table->string('meta_title')->nullable(); // SEO
            $table->text('meta_description')->nullable(); // SEO
            $table->integer('read_time')->nullable(); // Estimated reading time in minutes
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamps();

            // Indexes for better performance
            $table->index(['is_published', 'published_at']);
            $table->index('category');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_tips');
    }
};
