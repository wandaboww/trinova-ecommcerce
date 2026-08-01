<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ============================================================
        // LEADS — Tabel terpenting
        // ============================================================
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('business_type')->nullable();
            $table->string('marketplace')->nullable();
            $table->string('monthly_revenue')->nullable();
            $table->string('team_size')->nullable();
            $table->string('website')->nullable();
            $table->text('message')->nullable();
            $table->string('lead_source')->default('audit_form');
            $table->enum('status', [
                'new', 'contacted', 'meeting',
                'proposal', 'negotiation', 'won', 'lost'
            ])->default('new');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });

        // LEAD_ACTIVITIES
        Schema::create('lead_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('activity');
            $table->text('notes')->nullable();
            $table->timestamp('activity_date')->nullable();
            $table->timestamps();
        });

        // AUDIT_REQUESTS
        Schema::create('audit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->string('current_marketplace')->nullable();
            $table->string('monthly_orders')->nullable();
            $table->string('monthly_ads_cost')->nullable();
            $table->text('main_problem')->nullable();
            $table->text('goal')->nullable();
            $table->string('preferred_schedule')->nullable();
            $table->enum('status', ['pending', 'scheduled', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // ============================================================
        // CONTACTS
        // ============================================================
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->enum('status', ['unread', 'read', 'replied'])->default('unread');
            $table->timestamps();
        });

        // NEWSLETTER_SUBSCRIBERS
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->enum('status', ['active', 'unsubscribed'])->default('active');
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamps();
        });

        // ============================================================
        // SEO_META
        // ============================================================
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();
            $table->string('page_type'); // landing, article, portfolio, program
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical')->nullable();
            $table->string('robots')->default('index, follow');
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->json('schema_json')->nullable();
            $table->timestamps();

            $table->index(['page_type', 'reference_id']);
        });

        // ============================================================
        // MEDIA LIBRARY
        // ============================================================
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('file_name');
            $table->string('original_name');
            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->string('extension')->nullable();
            $table->unsignedInteger('size')->nullable()->comment('bytes');
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        // ============================================================
        // WEBSITE SETTINGS
        // ============================================================
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Trinova Digital');
            $table->string('site_tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('media');
        Schema::dropIfExists('seo_metas');
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('audit_requests');
        Schema::dropIfExists('lead_activities');
        Schema::dropIfExists('leads');
    }
};
