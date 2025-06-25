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
        Schema::create('tour_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade');

            // Main safari features
            $table->boolean('gorilla_trekking')->default(false);
            $table->boolean('wildlife_safari')->default(false);
            $table->boolean('cultural_experience')->default(false);
            $table->boolean('birding')->default(false);
            $table->boolean('photography')->default(false);
            $table->boolean('adventure_activities')->default(false);

            // Additional features
            $table->boolean('family_friendly')->default(false);
            $table->boolean('big_five_viewing')->default(false);
            $table->boolean('night_game_drives')->default(false);
            $table->boolean('walking_safaris')->default(false);
            $table->boolean('boat_rides')->default(false);
            $table->boolean('cultural_visits')->default(false);
            $table->boolean('mountain_climbing')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_features');
    }
};
