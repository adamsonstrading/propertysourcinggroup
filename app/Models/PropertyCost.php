<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCost extends Model
{
    protected $fillable = ['available_property_id', 'name', 'amount'];

    public function property()
    {
        return $this->belongsTo(AvailableProperty::class, 'available_property_id');
    }
}
