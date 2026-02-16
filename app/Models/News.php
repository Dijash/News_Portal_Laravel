<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'author',
        'image',
        'url',
        'published_at',
        'is_approved',
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'is_approved' => 'boolean',
    ];
}
