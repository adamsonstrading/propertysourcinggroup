<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'role', 'category', 'bio', 'image_url', 'linkedin_url', 'sort_order'];
}
