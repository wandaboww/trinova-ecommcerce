<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name'    => 'Omset Digital',
                'site_tagline' => 'Jasa Pembuatan Website E-Commerce UMKM',
                'email'        => 'halo@omsetdigital.com',
                'phone'        => '6281234567890',
                'whatsapp'     => '6281234567890',
                'address'      => 'Jakarta, Indonesia',
            ]
        );
    }
}
