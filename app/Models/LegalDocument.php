<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LegalDocument extends Model
{
    protected $fillable = [
        'type', 'title', 'subtitle', 'version',
        'effective_date', 'meta_title', 'meta_description',
        'status', 'published_at',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'published_at'   => 'datetime',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(LegalSection::class)->orderBy('sort_order');
    }

    public function activeSections(): HasMany
    {
        return $this->hasMany(LegalSection::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
