<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'long_description',
        'image',
        'tech_stack',
        'apple_store_url',
        'google_play_url',
        'website_url',
        'github_url',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
    ];
}
