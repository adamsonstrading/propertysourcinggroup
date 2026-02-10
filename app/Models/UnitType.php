<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $fillable = ['name', 'property_type_id'];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
