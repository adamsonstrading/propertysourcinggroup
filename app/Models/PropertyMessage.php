<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyMessage extends Model
{
    protected $fillable = ['available_property_id', 'sender_id', 'receiver_id', 'message', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(AvailableProperty::class, 'available_property_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
