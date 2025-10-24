<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'role',
        'position',
        'slug',
        'photo',
        'bio',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'github_url',
        'website_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}