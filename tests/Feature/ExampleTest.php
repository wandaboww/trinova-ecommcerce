<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->withoutVite();
        $response = $this->get('/');

        $response->assertStatus(200);
        $this->assertTrue(\Illuminate\Support\Facades\Cache::has('landing_page_data'));
    }

    public function test_cache_is_invalidated_when_landing_settings_are_updated(): void
    {
        $this->withoutVite();
        $this->get('/');
        $this->assertTrue(\Illuminate\Support\Facades\Cache::has('landing_page_data'));

        $setting = \App\Models\LandingSetting::first() ?? new \App\Models\LandingSetting();
        $setting->hero_title = 'Judul Baru Super Cepat';
        $setting->save();

        $this->assertFalse(\Illuminate\Support\Facades\Cache::has('landing_page_data'));
    }

    public function test_blog_page_returns_successful_response(): void
    {
        $this->withoutVite();
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_audit_page_returns_successful_response(): void
    {
        $this->withoutVite();
        $response = $this->get('/analisa-bisnis-gratis');
        $response->assertStatus(200);
    }

    public function test_program_show_page_returns_successful_response(): void
    {
        $this->withoutVite();
        $program = \App\Models\Program::create([
            'title' => 'Program Test',
            'slug' => 'program-test',
            'short_description' => 'Short desc',
            'description' => 'Long desc',
            'target_market' => 'UMKM',
            'outcome' => [['icon' => 'check', 'text' => 'Outcome 1', 'custom_class' => '']],
            'topics' => [
                ['key' => 'features', 'icon' => '⚡', 'title' => 'Fitur & Arsitektur Platform', 'subtitle' => 'Sub', 'content' => json_encode([['icon' => 'check', 'text' => 'Fitur 1', 'custom_class' => '']])]
            ]
        ]);

        $response = $this->get('/program/' . $program->slug);
        $response->assertStatus(200);
        $response->assertSee('Fitur 1');
    }
}
