<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'description',
        'bmv_percentage',
        'image_url',
        'type',
        'yield',
        'features',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
