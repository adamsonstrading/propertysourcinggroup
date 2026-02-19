<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PropertyCost;
use App\Models\PropertyTenant;
use App\Models\PropertyOffer;
use App\Models\PropertyMessage;
use App\Models\PropertyFavorite;

class AvailableProperty extends Model
{
    protected $fillable = [
        'user_id',
        'headline',
        'location',
        'latitude',
        'longitude',
        'marketing_purpose_id',
        'price',
        'discount_available',
        'property_type_id',
        'unit_type_id',
        'area_sq_ft',
        'bedrooms',
        'bathrooms',
        'full_description',
        'thumbnail',
        'gallery_images',
        'video_url',
        'is_active',
        'status',
        // New Investment Details
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
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'discount_available' => 'boolean',
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'current_value' => 'decimal:2',
        'loan_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'monthly_rent' => 'decimal:2',
        'service_charge' => 'decimal:2',
        'ground_rent' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'purchase_date' => 'date',
        'sale_date' => 'date',
        'gas_safety_issue_date' => 'date',
        'gas_safety_expiry_date' => 'date',
        'electrical_issue_date' => 'date',
        'electrical_expiry_date' => 'date',
        'is_currently_rented' => 'boolean',
    ];

    public function marketingPurpose()
    {
        return $this->belongsTo(MarketingPurpose::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'available_property_feature');
    }

    public function costs()
    {
        return $this->hasMany(PropertyCost::class);
    }

    public function tenants()
    {
        return $this->hasMany(PropertyTenant::class);
    }

    public function offers()
    {
        return $this->hasMany(PropertyOffer::class);
    }

    public function messages()
    {
        return $this->hasMany(PropertyMessage::class);
    }

    public function favorites()
    {
        return $this->hasMany(PropertyFavorite::class);
    }

    public function isFavoritedBy($user = null)
    {
        if (!$user && auth()->check()) {
            $user = auth()->user();
        }

        if (!$user) {
            return false;
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
