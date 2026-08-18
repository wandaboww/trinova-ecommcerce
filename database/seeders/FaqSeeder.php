<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question'   => 'Apakah Omset Digital hanya untuk bisnis online?',
                'answer'     => 'Tidak. Kami melayani bisnis offline maupun online yang ingin membangun kehadiran digital yang profesional dan menghasilkan omzet nyata.',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'question'   => 'Berapa lama waktu pengerjaan websitenya?',
                'answer'     => 'Untuk paket START & GROW, pengerjaan antara 14–21 hari kerja. Untuk SCALE & EMPIRE, estimasi 30–60 hari kerja tergantung kompleksitas.',
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'question'   => 'Apakah saya perlu paham teknis untuk menggunakan sistemnya?',
                'answer'     => 'Tidak perlu! Semua sistem kami dirancang agar mudah dioperasikan oleh pemilik bisnis tanpa background IT sama sekali.',
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'question'   => 'Apakah ada garansi hasil?',
                'answer'     => 'Kami memberikan garansi revisi desain dan teknis hingga Anda puas. Untuk performa omzet, kami memberikan panduan optimasi 90 hari pasca-launch.',
                'sort_order' => 4,
                'is_active'  => true,
            ],
            [
                'question'   => 'Bagaimana cara pembayarannya?',
                'answer'     => 'Pembayaran dilakukan secara DP 50% di awal, dan pelunasan 50% setelah proyek selesai dan disetujui. Kami menerima transfer bank dan QRIS.',
                'sort_order' => 5,
                'is_active'  => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
