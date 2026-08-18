<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'       => 'Rina Cahyani',
                'company'    => 'Hijab Nisa',
                'position'   => 'Founder',
                'content'    => 'Omzet kami naik 3x lipat dalam 4 bulan setelah menggunakan sistem dari Omset Digital. Tim-nya profesional dan hasil website-nya benar-benar konversi tinggi!',
                'rating'     => 5,
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'name'       => 'Budi Prasetyo',
                'company'    => 'TechGadget ID',
                'position'   => 'CEO',
                'content'    => 'Dari yang tadinya hanya jual di marketplace, kini kami punya ekosistem digital mandiri. WhatsApp automation-nya luar biasa, closing rate naik 60%.',
                'rating'     => 5,
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'name'       => 'Siti Marlina',
                'company'    => 'Skincare By Marlin',
                'position'   => 'Owner',
                'content'    => 'Paling suka proses auditnya yang sangat detail. Saya jadi tahu persis apa yang harus diperbaiki. Website baru kami lebih kencang dan profesional.',
                'rating'     => 5,
                'sort_order' => 3,
                'is_active'  => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }
    }
}
