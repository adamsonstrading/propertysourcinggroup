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
        $adminId = \App\Models\User::where('role', 'admin')->value('id');
        if ($adminId) {
            \App\Models\Property::whereNull('user_id')->update(['user_id' => $adminId]);
            \App\Models\AvailableProperty::whereNull('user_id')->update(['user_id' => $adminId]);
        }
    }

    public function down(): void
    {
        //
    }
};
