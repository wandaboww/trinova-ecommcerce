<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'client_name', 'industry',
        'problem', 'solution', 'result', 'thumbnail',
        'website_url', 'is_featured', 'published_at',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->whereNotNull('published_at');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
