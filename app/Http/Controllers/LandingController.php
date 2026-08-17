<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\LandingSetting;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $data = Cache::remember('landing_page_data', 86400, function () {
            return [
                'programs'       => Program::active()->ordered()->get(),
                'portfolios'     => Portfolio::featured()->latest()->take(6)->get(),
                'testimonials'   => Testimonial::active()->ordered()->get(),
                'faqs'           => Faq::active()->ordered()->take(10)->get(),
                'setting'        => LandingSetting::first(),
                'generalSetting' => Setting::first(),
            ];
        });

        return view('landing.index', $data);
    }

    public function seoShopee()
    {
        return view('landing.seo.shopee');
    }

    public function seoTokopedia()
    {
        return view('landing.seo.tokopedia');
    }

    public function seoOnlineShop()
    {
        return view('landing.seo.online-shop');
    }

    public function seoUmkm()
    {
        return view('landing.seo.umkm');
    }

    public function privacy()
    {
        return view('landing.privacy');
    }
}
