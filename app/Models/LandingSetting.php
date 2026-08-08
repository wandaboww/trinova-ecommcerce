<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    protected $fillable = [
        'hero_badge', 'hero_title', 'hero_subtitle', 'hero_cta', 'hero_cta_secondary',
        'hero_image', 'pain_title', 'pain_description',
        'paradigm_title', 'paradigm_description',
        'cta_title', 'cta_description', 'cta_button_text', 'cta_trust_text', 'footer_description',
        'stat_clients', 'stat_growth', 'audit_quota', 'whatsapp_message',
        'show_hero_badge', 'show_hero_subtitle', 'show_hero_title', 'show_hero_description',
        'show_hero_cta_primary', 'show_hero_cta_secondary', 'show_statistics',
        'hero_subtitle_size', 'hero_title_size',
    ];

    protected $casts = [
        'show_hero_badge'         => 'boolean',
        'show_hero_subtitle'      => 'boolean',
        'show_hero_title'         => 'boolean',
        'show_hero_description'   => 'boolean',
        'show_hero_cta_primary'   => 'boolean',
        'show_hero_cta_secondary' => 'boolean',
        'show_statistics'         => 'boolean',
    ];
}
