<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->string('cta_button_text')->nullable()->after('cta_description');
            $table->string('cta_trust_text')->nullable()->after('cta_button_text');
        });
    }

    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->dropColumn(['cta_button_text', 'cta_trust_text']);
        });
    }
};
