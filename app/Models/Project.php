<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'tech',
        'github',
        'live',
        'case',
        'readme',
        'video',
        'video_webm',
        'figma',
        'figma_images',
    ];

    protected $casts = [
        'tech' => 'array',
        'figma_images' => 'array', // ✅ conversion JSON -> array automatique
    ];
}
