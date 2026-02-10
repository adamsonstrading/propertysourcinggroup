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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'general', 'investor', 'event'
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('ready_to_buy')->nullable(); // For general inquiries
            $table->string('experience_level')->nullable(); // For event inquiries
            $table->text('comments')->nullable();
            $table->string('source_page')->nullable(); // Which page the form was submitted from
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
