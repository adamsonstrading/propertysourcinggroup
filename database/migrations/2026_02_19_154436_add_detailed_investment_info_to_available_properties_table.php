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
            // Pricing & Purchase
            $table->decimal('current_value', 12, 2)->nullable()->after('price');
            $table->date('purchase_date')->nullable()->after('current_value');

            // Financing
            $table->enum('financing_type', ['cash', 'mortgage'])->default('cash')->after('purchase_date');
            $table->decimal('loan_amount', 12, 2)->nullable()->after('financing_type');
            $table->decimal('interest_rate', 5, 2)->nullable()->after('loan_amount');
            $table->string('lender_name')->nullable()->after('interest_rate');
            $table->decimal('monthly_payment', 10, 2)->nullable()->after('lender_name');

            // Investment Type
            $table->enum('investment_type', ['buy_to_sell', 'rental'])->nullable()->after('monthly_payment');
            // Buy to Sell
            $table->decimal('sale_price', 12, 2)->nullable()->after('investment_type');
            $table->date('sale_date')->nullable()->after('sale_price');
            // Rental
            $table->decimal('monthly_rent', 10, 2)->nullable()->after('sale_date');
            $table->boolean('is_currently_rented')->default(false)->after('monthly_rent');

            // Tenure
            $table->enum('tenure_type', ['freehold', 'leasehold'])->nullable()->after('is_currently_rented');
            $table->decimal('service_charge', 10, 2)->nullable()->after('tenure_type'); // Annual
            $table->decimal('ground_rent', 10, 2)->nullable()->after('service_charge'); // Annual
            $table->integer('lease_years_remaining')->nullable()->after('ground_rent');

            // Compliance
            $table->date('gas_safety_issue_date')->nullable()->after('lease_years_remaining');
            $table->date('gas_safety_expiry_date')->nullable()->after('gas_safety_issue_date');
            $table->date('electrical_issue_date')->nullable()->after('gas_safety_expiry_date');
            $table->date('electrical_expiry_date')->nullable()->after('electrical_issue_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('available_properties', function (Blueprint $table) {
            $table->dropColumn([
                'current_value',
                'purchase_date',
                'financing_type',
                'loan_amount',
                'interest_rate',
                'lender_name',
                'monthly_payment',
                'investment_type',
                'sale_price',
                'sale_date',
                'monthly_rent',
                'is_currently_rented',
                'tenure_type',
                'service_charge',
                'ground_rent',
                'lease_years_remaining',
                'gas_safety_issue_date',
                'gas_safety_expiry_date',
                'electrical_issue_date',
                'electrical_expiry_date',
            ]);
        });
    }
};
