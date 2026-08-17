<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'company', 'position', 'photo',
        'content', 'rating', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'rating'     => 'integer',
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('landing_page_data');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('landing_page_data');
        });
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
