<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingSetting;
use App\Models\Setting;

class LandingManagerController extends Controller
{
    public function index()
    {
        $landingSetting = LandingSetting::first() ?? new LandingSetting();
        $generalSetting = Setting::first() ?? new Setting();
        return view('admin.landing.index', compact('landingSetting', 'generalSetting'));
    }

    public function update(Request $request)
    {
        // Update or create landing settings
        LandingSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_badge'         => $request->input('hero_badge'),
                'hero_title'         => $request->input('hero_headline'),
                'hero_subtitle'      => $request->input('hero_sub'),
                'hero_subtitle_size' => $request->input('hero_subtitle_size'),
                'hero_title_size'    => $request->input('hero_title_size'),
                'hero_cta'           => $request->input('hero_cta_primary'),
                'hero_cta_secondary' => $request->input('hero_cta_secondary'),
                'pain_description'   => $request->input('hero_description'),
                'stat_clients'       => $request->input('stat_clients'),
                'stat_growth'        => $request->input('stat_growth'),
                'audit_quota'        => $request->input('audit_quota'),
                'whatsapp_message'   => $request->input('whatsapp_message'),
                'cta_title'          => $request->input('cta_title'),
                'cta_description'    => $request->input('cta_description'),
                'cta_button_text'    => $request->input('cta_button_text'),
                'cta_trust_text'     => $request->input('cta_trust_text'),
                'show_hero_badge'         => $request->boolean('show_hero_badge'),
                'show_hero_subtitle'      => $request->boolean('show_hero_subtitle'),
                'show_hero_title'         => $request->boolean('show_hero_title'),
                'show_hero_description'   => $request->boolean('show_hero_description'),
                'show_hero_cta_primary'   => $request->boolean('show_hero_cta_primary'),
                'show_hero_cta_secondary' => $request->boolean('show_hero_cta_secondary'),
                'show_statistics'         => $request->boolean('show_statistics'),
                'show_whatsapp_float'     => $request->boolean('show_whatsapp_float'),
            ]
        );

        // Update general settings for whatsapp
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp'         => $request->input('whatsapp_number'),
                'phone'            => $request->input('whatsapp_number'),
                'whatsapp_message' => $request->input('whatsapp_message'),
            ]
        );

        return redirect()->back()->with('success', 'Konten Landing Page berhasil diperbarui.');
    }
}
