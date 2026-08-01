<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->boolean('show_hero_badge')->default(true)->after('hero_badge');
            $table->boolean('show_hero_subtitle')->default(true)->after('hero_subtitle');
            $table->boolean('show_hero_title')->default(true)->after('hero_title');
            $table->boolean('show_hero_description')->default(true)->after('pain_description');
            $table->boolean('show_hero_cta_primary')->default(true)->after('hero_cta');
            $table->boolean('show_hero_cta_secondary')->default(true)->after('hero_cta_secondary');
            $table->boolean('show_statistics')->default(true)->after('stat_growth');
        });
    }

    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->dropColumn([
                'show_hero_badge',
                'show_hero_subtitle',
                'show_hero_title',
                'show_hero_description',
                'show_hero_cta_primary',
                'show_hero_cta_secondary',
                'show_statistics',
            ]);
        });
    }
};
