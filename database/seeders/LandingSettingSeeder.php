<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingSetting;

class LandingSettingSeeder extends Seeder
{
    public function run(): void
    {
        LandingSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_title'           => 'Kami Bukan Agensi Biasa.',
                'hero_subtitle'        => 'Omzet UMKM & E-Commerce Anda Tumbuh',
                'hero_cta'             => 'Analisa Bisnis Gratis Sekarang',
                'pain_title'           => 'Mengapa Penjualan Online Anda Stagnan?',
                'pain_description'     => 'Banyak bisnis terjebak pada iklan mahal tanpa konversi, website lambat, dan funnel whatsapp manual yang melelahkan.',
                'paradigm_title'       => 'Dari Manual Menuju Otomatisasi Penjualan',
                'paradigm_description' => 'Omset Digital mengubah cara Anda berjualan dengan sistem landing page mandiri, payment gateway terintegrasi, dan CRM otomatis.',
                'cta_title'            => 'Siap Mengubah Bisnis E-Commerce Anda?',
                'cta_description'      => 'Dapatkan Konsultasi Gratis senilai Rp2.500.000 sekarang juga. Kuota terbatas setiap bulan!',
                'footer_description'   => 'Omset Digital membantu UMKM dan seller membangun website e-commerce dan toko online milik sendiri untuk mengembangkan brand secara mandiri.',
            ]
        );
    }
}
