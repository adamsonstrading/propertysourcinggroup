<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'hero_image_url',
        'short_description',
        'full_description',
        'author_name',
        'author_image_url'
    ];

    public function sections()
    {
        return $this->hasMany(ServiceSection::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
    }
}
