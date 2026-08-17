<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name', 'site_tagline', 'logo', 'favicon',
        'email', 'phone', 'whatsapp', 'whatsapp_message', 'address',
        'facebook', 'instagram', 'tiktok', 'youtube', 'linkedin',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('site_setting');
            \Illuminate\Support\Facades\Cache::forget('landing_page_data');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('site_setting');
            \Illuminate\Support\Facades\Cache::forget('landing_page_data');
        });
    }

    public static function getCached(): ?self
    {
        return \Illuminate\Support\Facades\Cache::remember('site_setting', 86400, function () {
            return self::first();
        });
    }
}
