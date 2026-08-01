<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt',
        'content', 'featured_image', 'status', 'published_at',
        'reading_time', 'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views'        => 'integer',
        'reading_time' => 'integer',
    ];

    const STATUS_DRAFT    = 'draft';
    const STATUS_REVIEW   = 'review';
    const STATUS_PUBLISHED= 'published';

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED)
                     ->where('published_at', '<=', now());
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->published()->orderBy('published_at', 'desc');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
