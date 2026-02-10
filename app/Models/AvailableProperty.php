<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
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
}
