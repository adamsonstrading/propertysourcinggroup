<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyOffer extends Model
{
    protected $fillable = ['available_property_id', 'user_id', 'offer_amount', 'status', 'notes'];

    protected $casts = [
        'offer_amount' => 'decimal:2',
    ];

    public function property()
    {
        return $this->belongsTo(AvailableProperty::class, 'available_property_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
