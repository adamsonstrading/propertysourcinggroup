<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'type', 'heading', 'content', 'image_url', 'sort_order'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
