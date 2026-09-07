<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'author',
        'views',
        'published_date',
        'is_published'
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_published' => 'boolean'
    ];

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_date', '<=', now());
    }
}