<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'description',
        'target_market', 'outcome', 'topics', 'icon', 'thumbnail',
        'sort_order', 'is_active', 'is_best_value',
        'spec_warranty', 'spec_speed', 'spec_support', 'spec_license',
        'original_price', 'current_price'
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'is_best_value' => 'boolean',
        'sort_order'    => 'integer',
        'outcome'       => 'array',
        'topics'        => 'array',
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

    public function getEffectiveTopicsAttribute()
    {
        if (is_array($this->topics) && count($this->topics) > 0) {
            return $this->topics;
        }

        return [
            [
                'key'          => 'overview',
                'icon'         => '📌',
                'title'        => 'Gambaran Umum & Benefit',
                'subtitle'     => 'Deskripsi narasi lengkap & poin hasil utama',
                'content'      => '',
                'custom_class' => '',
            ],
            [
                'key'          => 'features',
                'icon'         => '⚡',
                'title'        => 'Fitur & Arsitektur Platform',
                'subtitle'     => 'Rincian modul teknis & integrasi sistem',
                'content'      => '',
                'custom_class' => '',
            ],
            [
                'key'          => 'workflow',
                'icon'         => '🚀',
                'title'        => 'Alur Kerja & Roadmap',
                'subtitle'     => 'Tahapan eksekusi dari ide hingga rilis',
                'content'      => '',
                'custom_class' => '',
            ],
            [
                'key'          => 'specs',
                'icon'         => '🛠️',
                'title'        => 'Spesifikasi Layanan & SLA',
                'subtitle'     => 'Infrastruktur server, enkripsi & garansi',
                'content'      => '',
                'custom_class' => '',
            ],
        ];
    }

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
