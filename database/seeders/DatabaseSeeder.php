<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SettingSeeder::class,
            LandingSettingSeeder::class,
            ProgramSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            PortfolioSeeder::class,
            BlogSeeder::class,
            LegalDocumentSeeder::class,
        ]);
    }
}
