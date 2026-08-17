<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::latestPublished()->paginate(4);
            $categories = Category::withCount(['articles' => function ($query) {
                $query->published();
            }])->get();
            
            if ($articles->isEmpty()) {
                throw new \Exception("Database empty");
            }
        } catch (\Exception $e) {
            // Mock fallback
            $categoryMock = (object) ['name' => 'Bisnis Online', 'slug' => 'bisnis-online', 'articles_count' => 3];
            $categories = collect([$categoryMock]);
            
            $mockArticles = [
                (object) [
                    'id' => 1,
                    'title' => 'Mengapa Website Penting untuk Seller Marketplace',
                    'slug' => 'mengapa-website-penting-untuk-seller-marketplace',
                    'excerpt' => 'Pelajari bahaya ketergantungan 100% pada algoritma marketplace dan bagaimana website mandiri melipatgandakan margin profit Anda.',
                    'content' => '<p>Di era digital saat ini, jualan di Shopee, Tokopedia, atau TikTok Shop memang menggiurkan. Namun, tahukah Anda bahaya di baliknya? Kenaikan biaya admin sepihak, perang harga tiada akhir, serta risiko penutupan akun adalah momok menakutkan bagi seller.</p><p>Melalui website mandiri, Anda tidak hanya mengamankan bisnis Anda, tetapi juga memegang penuh kendali data pelanggan Anda sendiri untuk repeat order berkali-kali tanpa iklan berbayar.</p>',
                    'published_at' => now(),
                    'category' => $categoryMock,
                    'author' => 'Tim Omset Digital',
                    'featured_image' => null,
                    'views' => 124
                ],
                (object) [
                    'id' => 2,
                    'title' => 'Strategi Jitu Menghindari Perang Harga Brutal',
                    'slug' => 'strategi-jitu-menghindari-perang-harga-brutal',
                    'excerpt' => 'Bosan banting harga dengan kompetitor? Temukan langkah praktis membangun positioning brand agar dicari pelanggan tanpa memotong margin.',
                    'content' => '<p>Perang harga hanya menyisakan satu pemenang: marketplace yang memungut biaya admin. Sebagai seller, Anda harus membangun brand value sendiri agar produk dinilai dari kualitas, bukan harga termurah.</p>',
                    'published_at' => now()->subDay(),
                    'category' => $categoryMock,
                    'author' => 'Tim Omset Digital',
                    'featured_image' => null,
                    'views' => 98
                ]
            ];
            $articles = new \Illuminate\Pagination\LengthAwarePaginator($mockArticles, count($mockArticles), 4);
        }

        return view('blog.index', compact('articles', 'categories'));
    }

    public function category(string $slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $articles = $category->articles()->latestPublished()->paginate(4);
            $categories = Category::withCount(['articles' => function ($query) {
                $query->published();
            }])->get();
        } catch (\Exception $e) {
            $category = (object) ['name' => 'Bisnis Online', 'slug' => 'bisnis-online'];
            $categories = collect([$category]);
            $mockArticles = [
                (object) [
                    'id' => 1,
                    'title' => 'Mengapa Website Penting untuk Seller Marketplace',
                    'slug' => 'mengapa-website-penting-untuk-seller-marketplace',
                    'excerpt' => 'Pelajari bahaya ketergantungan 100% pada algoritma marketplace dan bagaimana website mandiri melipatgandakan margin profit Anda.',
                    'content' => '',
                    'published_at' => now(),
                    'category' => $category,
                    'author' => 'Tim Omset Digital',
                    'featured_image' => null,
                    'views' => 124
                ]
            ];
            $articles = new \Illuminate\Pagination\LengthAwarePaginator($mockArticles, count($mockArticles), 4);
        }

        return view('blog.category', compact('category', 'articles', 'categories'));
    }

    public function show(string $slug)
    {
        try {
            $article = Article::where('slug', $slug)->published()->firstOrFail();
            $article->incrementViews();
            
            $relatedArticles = Article::published()
                ->where('id', '!=', $article->id)
                ->where('category_id', $article->category_id)
                ->latestPublished()
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            // Mock details
            $categoryMock = (object) ['name' => 'Bisnis Online', 'slug' => 'bisnis-online'];
            $article = (object) [
                'id' => 1,
                'title' => 'Mengapa Website Penting untuk Seller Marketplace',
                'slug' => 'mengapa-website-penting-untuk-seller-marketplace',
                'excerpt' => 'Pelajari bahaya ketergantungan 100% pada algoritma marketplace.',
                'content' => '<p>Di era digital saat ini, jualan di Shopee, Tokopedia, atau TikTok Shop memang menggiurkan. Namun, tahukah Anda bahaya di baliknya? Kenaikan biaya admin sepihak, perang harga tiada akhir, serta risiko penutupan akun adalah momok menakutkan bagi seller.</p><p>Melalui website mandiri, Anda tidak hanya mengamankan bisnis Anda, tetapi juga memegang penuh kendali data pelanggan Anda sendiri untuk repeat order berkali-kali tanpa iklan berbayar.</p>',
                'published_at' => now(),
                'category' => $categoryMock,
                'author' => 'Tim Omset Digital',
                'views' => 125
            ];
            $relatedArticles = collect([
                (object) [
                    'id' => 2,
                    'title' => 'Strategi Jitu Menghindari Perang Harga Brutal',
                    'slug' => 'strategi-jitu-menghindari-perang-harga-brutal',
                    'published_at' => now()->subDay(),
                    'category' => $categoryMock
                ]
            ]);
        }

        return view('blog.show', compact('article', 'relatedArticles'));
    }
}
