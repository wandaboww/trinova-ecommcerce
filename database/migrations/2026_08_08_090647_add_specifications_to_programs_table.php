<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('spec_warranty')->nullable()->default('100% Turnkey Ready');
            $table->string('spec_speed')->nullable()->default('< 1.5 Detik');
            $table->string('spec_support')->nullable()->default('Tim Dedicated CS');
            $table->string('spec_license')->nullable()->default('Full Mandiri (100% Hak Milik)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['spec_warranty', 'spec_speed', 'spec_support', 'spec_license']);
        });
    }
};
