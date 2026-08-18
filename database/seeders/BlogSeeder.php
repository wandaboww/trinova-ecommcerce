<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::updateOrCreate(
            ['slug' => 'bisnis-online'],
            ['name' => 'Bisnis Online']
        );

        Article::updateOrCreate(
            ['slug' => 'mengapa-website-penting-untuk-seller-marketplace'],
            [
                'title'       => 'Mengapa Website Penting untuk Seller Marketplace',
                'category_id' => $category->id,
                'status'      => 'published',
                'excerpt'     => 'Pelajari bahaya ketergantungan 100% pada algoritma marketplace dan bagaimana website mandiri melipatgandakan margin profit Anda.',
                'content'     => '<p>Di era digital saat ini, jualan di Shopee, Tokopedia, atau TikTok Shop memang menggiurkan. Namun, tahukah Anda bahaya di baliknya? Kenaikan biaya admin sepihak, perang harga tiada akhir, serta risiko penutupan akun adalah momok menakutkan bagi seller.</p><p>Melalui website mandiri, Anda tidak hanya mengamankan bisnis Anda, tetapi juga memegang penuh kendali data pelanggan Anda sendiri untuk repeat order berkali-kali tanpa iklan berbayar.</p>',
                'published_at' => now(),
                'user_id'     => 1,
            ]
        );

        Article::updateOrCreate(
            ['slug' => 'strategi-jitu-menghindari-perang-harga-brutal'],
            [
                'title'       => 'Strategi Jitu Menghindari Perang Harga Brutal',
                'category_id' => $category->id,
                'status'      => 'published',
                'excerpt'     => 'Bosan banting harga dengan kompetitor? Temukan langkah praktis membangun positioning brand agar dicari pelanggan tanpa memotong margin.',
                'content'     => '<p>Perang harga hanya menyisakan satu pemenang: marketplace yang memungut biaya admin. Sebagai seller, Anda harus membangun brand value sendiri agar produk dinilai dari kualitas, bukan harga termurah.</p>',
                'published_at' => now()->subDay(),
                'user_id'     => 1,
            ]
        );
    }
}
