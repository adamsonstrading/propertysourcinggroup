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
        Schema::create('available_properties', function (Blueprint $table) {
            $table->id();
            $table->string('headline');
            $table->string('location'); // UK Address
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('marketing_purpose')->nullable(); // Rent/Sale
            $table->decimal('price', 12, 2);
            $table->boolean('discount_available')->default(false);
            $table->string('property_type');
            $table->string('unit_type')->nullable(); // Category
            $table->integer('area_sq_ft')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->text('full_description');
            $table->json('features')->nullable(); // Amenities
            $table->string('thumbnail')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_properties');
    }
};
