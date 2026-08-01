<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->string('hero_badge')->nullable()->after('id');
            $table->string('hero_cta_secondary')->nullable()->after('hero_cta');
            $table->string('stat_clients')->nullable()->after('footer_description');
            $table->string('stat_growth')->nullable()->after('stat_clients');
            $table->integer('audit_quota')->nullable()->after('stat_growth');
            $table->string('whatsapp_message')->nullable()->after('audit_quota');
        });
    }

    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge',
                'hero_cta_secondary',
                'stat_clients',
                'stat_growth',
                'audit_quota',
                'whatsapp_message',
            ]);
        });
    }
};
