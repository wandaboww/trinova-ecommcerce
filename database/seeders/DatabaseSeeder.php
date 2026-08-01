<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LandingSetting;
use App\Models\Program;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@trinovadigital.com'],
            [
                'name' => 'Admin Trinova',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Landing Settings
        LandingSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'Kami Bukan Agensi Biasa.',
                'hero_subtitle' => 'Omzet UMKM & E-Commerce Anda Tumbuh',
                'hero_cta' => 'Audit Bisnis Gratis Sekarang',
                'pain_title' => 'Mengapa Penjualan Online Anda Stagnan?',
                'pain_description' => 'Banyak bisnis terjebak pada iklan mahal tanpa konversi, website lambat, dan funnel whatsapp manual yang melelahkan.',
                'paradigm_title' => 'Dari Manual Menuju Otomatisasi Penjualan',
                'paradigm_description' => 'Trinova mengubah cara Anda berjualan dengan sistem landing page mandiri, payment gateway terintegrasi, dan CRM otomatis.',
                'cta_title' => 'Siap Mengubah Bisnis E-Commerce Anda?',
                'cta_description' => 'Dapatkan Audit Bisnis Gratis senilai Rp2.500.000 sekarang juga. Kuota terbatas setiap bulan!',
                'footer_description' => 'Trinova Digital membantu brand e-commerce dan UMKM Indonesia tumbuh lewat sistem website konversi tinggi dan otomatisasi penjualan.',
            ]
        );

        // 3. Programs
        $programs = [
            [
                'title' => 'START',
                'slug' => 'start',
                'short_description' => 'Validasi produk dan buat funnel penjualan online pertama Anda dengan struktur yang matang.',
                'target_market' => 'Pemula / Brand Baru',
                'outcome' => 'Landing Page Konversi Tinggi & Funnel WhatsApp Ready',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'GROW',
                'slug' => 'grow',
                'short_description' => 'Mulai berpindah dari marketplace ke website mandiri dengan sistem pembayaran terintegrasi.',
                'target_market' => 'Seller Ingin Mandiri',
                'outcome' => 'E-Commerce Lengkap, Payment Gateway, & WhatsApp Automation',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'SCALE',
                'slug' => 'scale',
                'short_description' => 'Tingkatkan profit bisnis dengan automasi pemasaran, CRM, SEO, dan kurir otomatis.',
                'target_market' => 'Brand Ingin Tumbuh',
                'outcome' => 'Sistem CRM, Optimasi SEO Google Rank 1, & Kurir Pro',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'EMPIRE',
                'slug' => 'empire',
                'short_description' => 'Membangun ekosistem ERP mandiri untuk mengelola multi-warehouse dan custom mobile apps.',
                'target_market' => 'Penguasa Pasar / Enterprise',
                'outcome' => 'Aplikasi Android & iOS, Sistem ERP Kustom, & Dedicated Support',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 4. Testimonials
        $testimonials = [
            [
                'name' => 'Rina Cahyani',
                'company' => 'Hijab Nisa',
                'position' => 'Founder',
                'content' => 'Omzet kami naik 3x lipat dalam 4 bulan setelah menggunakan sistem dari Trinova. Tim-nya profesional dan hasil website-nya benar-benar konversi tinggi!',
                'rating' => 5,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Prasetyo',
                'company' => 'TechGadget ID',
                'position' => 'CEO',
                'content' => 'Dari yang tadinya hanya jual di marketplace, kini kami punya ekosistem digital mandiri. WhatsApp automation-nya luar biasa, closing rate naik 60%.',
                'rating' => 5,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Marlina',
                'company' => 'Skincare By Marlin',
                'position' => 'Owner',
                'content' => 'Paling suka proses auditnya yang sangat detail. Saya jadi tahu persis apa yang harus diperbaiki. Website baru kami lebih kencang dan profesional.',
                'rating' => 5,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $index => $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }

        // 5. FAQs
        $faqs = [
            [
                'question' => 'Apakah Trinova Digital hanya untuk bisnis online?',
                'answer' => 'Tidak. Kami melayani bisnis offline maupun online yang ingin membangun kehadiran digital yang profesional dan menghasilkan omzet nyata.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu pengerjaan websitenya?',
                'answer' => 'Untuk paket START & GROW, pengerjaan antara 14–21 hari kerja. Untuk SCALE & EMPIRE, estimasi 30–60 hari kerja tergantung kompleksitas.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya perlu paham teknis untuk menggunakan sistemnya?',
                'answer' => 'Tidak perlu! Semua sistem kami dirancang agar mudah dioperasikan oleh pemilik bisnis tanpa background IT sama sekali.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada garansi hasil?',
                'answer' => 'Kami memberikan garansi revisi desain dan teknis hingga Anda puas. Untuk performa omzet, kami memberikan panduan optimasi 90 hari pasca-launch.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara pembayarannya?',
                'answer' => 'Pembayaran dilakukan secara DP 50% di awal, dan pelunasan 50% setelah proyek selesai dan disetujui. Kami menerima transfer bank dan QRIS.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // 6. Portfolios
        $portfolios = [
            [
                'title' => 'Hijab Brand A Scaling Project',
                'slug' => 'hijab-brand-a',
                'client_name' => 'Hijab Brand A',
                'industry' => 'Fashion Muslim',
                'problem' => 'Mengalami ketergantungan tinggi pada promo diskon di marketplace yang mengikis margin laba bersih.',
                'solution' => 'Membangun direct-to-consumer (D2C) online store dengan landing page premium teroptimasi dan automasi WhatsApp.',
                'result' => 'Omzet Rp18jt → Rp85jt/bulan',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Skincare Lokal C Launching',
                'slug' => 'skincare-brand-c',
                'client_name' => 'Skincare Brand C',
                'industry' => 'Skincare Lokal',
                'problem' => 'Sulit meningkatkan konversi landing page berbayar, biaya perolehan pelanggan (CAC) sangat tinggi.',
                'solution' => 'Mendesain ulang user experience landing page dengan struktur copywriting persuasif dan checkout kilat.',
                'result' => 'Konversi Landing Page Naik Hingga 4.2%',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'FMCG FoodPack Order System',
                'slug' => 'foodpack-co',
                'client_name' => 'FoodPack Co.',
                'industry' => 'FMCG Makanan',
                'problem' => 'Proses verifikasi manual transfer bank memakan waktu lama dan menyebabkan penumpukan antrean order.',
                'solution' => 'Mengintegrasikan payment gateway otomatis dengan notifikasi realtime ke kurir logistik pihak ketiga.',
                'result' => '3.800 Order/bulan Otomatis dari Iklan',
                'is_featured' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($portfolios as $p) {
            Portfolio::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 7. General Settings
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Trinova Digital',
                'site_tagline' => 'Digital Growth Platform',
                'email' => 'hello@trinovadigital.com',
                'phone' => '6281234567890',
                'whatsapp' => '6281234567890',
                'address' => 'Jakarta, Indonesia',
            ]
        );

        // 8. Blog Categories & Articles
        $category = \App\Models\Category::updateOrCreate(
            ['slug' => 'bisnis-online'],
            ['name' => 'Bisnis Online']
        );

        \App\Models\Article::updateOrCreate(
            ['slug' => 'mengapa-website-penting-untuk-seller-marketplace'],
            [
                'title' => 'Mengapa Website Penting untuk Seller Marketplace',
                'category_id' => $category->id,
                'status' => 'published',
                'excerpt' => 'Pelajari bahaya ketergantungan 100% pada algoritma marketplace dan bagaimana website mandiri melipatgandakan margin profit Anda.',
                'content' => '<p>Di era digital saat ini, jualan di Shopee, Tokopedia, atau TikTok Shop memang menggiurkan. Namun, tahukah Anda bahaya di baliknya? Kenaikan biaya admin sepihak, perang harga tiada akhir, serta risiko penutupan akun adalah momok menakutkan bagi seller.</p><p>Melalui website mandiri, Anda tidak hanya mengamankan bisnis Anda, tetapi juga memegang penuh kendali data pelanggan Anda sendiri untuk repeat order berkali-kali tanpa iklan berbayar.</p>',
                'published_at' => now(),
                'user_id' => 1,
            ]
        );

        \App\Models\Article::updateOrCreate(
            ['slug' => 'strategi-jitu-menghindari-perang-harga-brutal'],
            [
                'title' => 'Strategi Jitu Menghindari Perang Harga Brutal',
                'category_id' => $category->id,
                'status' => 'published',
                'excerpt' => 'Bosan banting harga dengan kompetitor? Temukan langkah praktis membangun positioning brand agar dicari pelanggan tanpa memotong margin.',
                'content' => '<p>Perang harga hanya menyisakan satu pemenang: marketplace yang memungut biaya admin. Sebagai seller, Anda harus membangun brand value sendiri agar produk dinilai dari kualitas, bukan harga termurah.</p>',
                'published_at' => now()->subDay(),
                'user_id' => 1,
            ]
        );
    }
}
