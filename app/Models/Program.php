<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'description',
        'target_market', 'outcome', 'icon', 'thumbnail',
        'sort_order', 'is_active', 'is_best_value',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'is_best_value' => 'boolean',
        'sort_order'    => 'integer',
        'outcome'       => 'array',
    ];

    public function features()
    {
        return $this->hasMany(ProgramFeature::class)->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
