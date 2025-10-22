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
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}