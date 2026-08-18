<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title'             => 'START',
                'slug'              => 'start',
                'short_description' => 'Validasi produk dan buat funnel penjualan online pertama Anda dengan struktur yang matang.',
                'target_market'     => 'Pemula / Brand Baru',
                'outcome'           => 'Landing Page Konversi Tinggi & Funnel WhatsApp Ready',
                'sort_order'        => 1,
                'is_active'         => true,
            ],
            [
                'title'             => 'GROW',
                'slug'              => 'grow',
                'short_description' => 'Mulai berpindah dari marketplace ke website mandiri dengan sistem pembayaran terintegrasi.',
                'target_market'     => 'Seller Ingin Mandiri',
                'outcome'           => 'E-Commerce Lengkap, Payment Gateway, & WhatsApp Automation',
                'sort_order'        => 2,
                'is_active'         => true,
            ],
            [
                'title'             => 'SCALE',
                'slug'              => 'scale',
                'short_description' => 'Tingkatkan profit bisnis dengan automasi pemasaran, CRM, SEO, dan kurir otomatis.',
                'target_market'     => 'Brand Ingin Tumbuh',
                'outcome'           => 'Sistem CRM, Optimasi SEO Google Rank 1, & Kurir Pro',
                'sort_order'        => 3,
                'is_active'         => true,
            ],
            [
                'title'             => 'EMPIRE',
                'slug'              => 'empire',
                'short_description' => 'Membangun ekosistem ERP mandiri untuk mengelola multi-warehouse dan custom mobile apps.',
                'target_market'     => 'Penguasa Pasar / Enterprise',
                'outcome'           => 'Aplikasi Android & iOS, Sistem ERP Kustom, & Dedicated Support',
                'sort_order'        => 4,
                'is_active'         => true,
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], $prog);
        }
    }
}
