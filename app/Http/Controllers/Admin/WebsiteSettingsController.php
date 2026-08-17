<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

use App\Models\LandingSetting;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name'        => $request->input('company_name'),
                'email'            => $request->input('contact_email'),
                'whatsapp'         => $request->input('whatsapp_number'),
                'phone'            => $request->input('whatsapp_number'),
                'whatsapp_message' => $request->input('whatsapp_message'),
                'instagram'        => $request->input('social_instagram'),
                'tiktok'           => $request->input('social_tiktok'),
                'youtube'          => $request->input('social_youtube'),
                'address'          => $request->input('address', 'Jakarta, Indonesia'),
                'site_tagline'     => $request->input('meta_title'),
            ]
        );

        LandingSetting::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp_message' => $request->input('whatsapp_message'),
            ]
        );

        \Illuminate\Support\Facades\Cache::forget('landing_page_data');
        \Illuminate\Support\Facades\Cache::forget('landing_setting');
        \Illuminate\Support\Facades\Cache::forget('site_setting');

        return redirect()->back()->with('success', 'Website settings updated successfully.');
    }
}
