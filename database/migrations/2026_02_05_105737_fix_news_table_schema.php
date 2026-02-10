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
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
            if (!Schema::hasColumn('news', 'excerpt') && !Schema::hasColumn('news', 'summary')) {
                $table->text('excerpt')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('news', 'content')) {
                $table->longText('content')->nullable()->after('image_url');
            }
            if (!Schema::hasColumn('news', 'author_name')) {
                $table->string('author_name')->nullable()->after('content');
            }
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('author_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
