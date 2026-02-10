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
        Schema::table('available_properties', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['marketing_purpose', 'property_type', 'unit_type', 'features']);

            // Add new FK columns
            $table->foreignId('marketing_purpose_id')->nullable()->after('location')->constrained()->nullOnDelete();
            $table->foreignId('property_type_id')->nullable()->after('marketing_purpose_id')->constrained()->nullOnDelete();
            $table->foreignId('unit_type_id')->nullable()->after('property_type_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('available_properties', function (Blueprint $table) {
            $table->dropForeign(['marketing_purpose_id']);
            $table->dropForeign(['property_type_id']);
            $table->dropForeign(['unit_type_id']);
            $table->dropColumn(['marketing_purpose_id', 'property_type_id', 'unit_type_id']);

            $table->string('marketing_purpose')->nullable();
            $table->string('property_type')->nullable();
            $table->string('unit_type')->nullable();
            $table->json('features')->nullable();
        });
    }
};
