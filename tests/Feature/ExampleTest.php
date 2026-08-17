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
}
