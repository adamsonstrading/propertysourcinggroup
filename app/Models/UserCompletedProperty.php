<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompletedProperty extends Model
{
    protected $fillable = [
        'user_id',
        'property_address',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
