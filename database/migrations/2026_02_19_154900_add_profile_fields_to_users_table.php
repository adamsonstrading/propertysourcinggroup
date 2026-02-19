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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('phone')->nullable()->after('email'); // Already exists
            // $table->enum('purchase_reference', ['individual', 'company'])->default('individual')->after('email'); // Already exists

            // Individual Address
            // $table->string('address')->nullable()->after('purchase_reference'); // Already exists
            // $table->string('town')->nullable()->after('email'); // Already exists
            // $table->string('postcode')->nullable()->after('town'); // Already exists

            // Company Details
            $table->string('company_name')->nullable()->after('postcode');
            $table->string('company_registration_number')->nullable()->after('company_name');
            $table->string('company_address')->nullable()->after('company_registration_number');
            $table->string('company_town')->nullable()->after('company_address');
            $table->string('company_postcode')->nullable()->after('company_town');
            $table->string('company_city_country')->nullable()->after('company_postcode');

            // Credits
            $table->integer('investment_credits')->default(0)->after('company_city_country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'purchase_reference',
                'address',
                'town',
                'postcode',
                'company_name',
                'company_registration_number',
                'company_address',
                'company_town',
                'company_postcode',
                'company_city_country',
                'investment_credits',
            ]);
        });
    }
};
