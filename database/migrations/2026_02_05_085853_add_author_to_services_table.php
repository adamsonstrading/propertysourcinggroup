<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('author_name')->nullable()->after('full_description');
            $table->string('author_image_url')->nullable()->after('author_name');
            $table->string('hero_image_url')->nullable()->after('icon');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['author_name', 'author_image_url', 'hero_image_url']);
        });
    }
};
