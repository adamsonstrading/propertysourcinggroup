<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustpilotReview extends Model
{
    protected $fillable = [
        'rating_stars',
        'review_text',
        'is_active',
    ];
}
