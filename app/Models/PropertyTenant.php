<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTenant extends Model
{
    protected $fillable = ['available_property_id', 'name', 'phone', 'email', 'is_primary'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(AvailableProperty::class, 'available_property_id');
    }
}
