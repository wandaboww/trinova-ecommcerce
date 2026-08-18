<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'title'       => 'Hijab Brand A Scaling Project',
                'slug'        => 'hijab-brand-a',
                'client_name' => 'Hijab Brand A',
                'industry'    => 'Fashion Muslim',
                'problem'     => 'Mengalami ketergantungan tinggi pada promo diskon di marketplace yang mengikis margin laba bersih.',
                'solution'    => 'Membangun direct-to-consumer (D2C) online store dengan landing page premium teroptimasi dan automasi WhatsApp.',
                'result'      => 'Omzet Rp18jt → Rp85jt/bulan',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'title'       => 'Skincare Lokal C Launching',
                'slug'        => 'skincare-brand-c',
                'client_name' => 'Skincare Brand C',
                'industry'    => 'Skincare Lokal',
                'problem'     => 'Sulit meningkatkan konversi landing page berbayar, biaya perolehan pelanggan (CAC) sangat tinggi.',
                'solution'    => 'Mendesain ulang user experience landing page dengan struktur copywriting persuasif dan checkout kilat.',
                'result'      => 'Konversi Landing Page Naik Hingga 4.2%',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'title'       => 'FMCG FoodPack Order System',
                'slug'        => 'foodpack-co',
                'client_name' => 'FoodPack Co.',
                'industry'    => 'FMCG Makanan',
                'problem'     => 'Proses verifikasi manual transfer bank memakan waktu lama dan menyebabkan penumpukan antrean order.',
                'solution'    => 'Mengintegrasikan payment gateway otomatis dengan notifikasi realtime ke kurir logistik pihak ketiga.',
                'result'      => '3.800 Order/bulan Otomatis dari Iklan',
                'is_featured' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($portfolios as $p) {
            Portfolio::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
