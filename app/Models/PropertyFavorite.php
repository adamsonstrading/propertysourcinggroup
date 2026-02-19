<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFavorite extends Model
{
    protected $fillable = ['user_id', 'available_property_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(AvailableProperty::class, 'available_property_id');
    }
}
