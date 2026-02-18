<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trustpilot_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review_text')->nullable(); // For the "numbers" which is text
            $table->decimal('rating_stars', 2, 1)->default(5.0); // For the stars
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trustpilot_reviews');
    }
};
