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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();

            // Basic hero content
            $table->string('title',255)->unique();
            $table->string('subtitle')->nullable();
            $table->text('description');

            // Call-to-action buttons
            $table->string('primary_button_text')->nullable();
            $table->string('primary_button_link')->nullable();
            $table->string('secondary_button_text')->nullable();
            $table->string('secondary_button_link')->nullable();

            // Media content
            $table->string('background_image');
            $table->string('background_video')->nullable();
            $table->json('gallery_images')->nullable(); // For multiple images

            // Search functionality
            $table->boolean('show_search_bar')->default(true);
            $table->string('search_placeholder')->default('Search tours...');

            // Layout and styling
            $table->enum('layout_type', ['full_width', 'boxed', 'split'])->default('full_width');
            $table->enum('text_alignment', ['left', 'center', 'right'])->default('center');
            $table->string('overlay_color')->nullable(); // For background overlay
            $table->integer('overlay_opacity')->default(50); // 0-100

            // Content positioning
            $table->enum('content_position', ['top', 'center', 'bottom'])->default('center');
            $table->boolean('show_scroll_indicator')->default(true);

            // Status and ordering
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
