<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Static routes
        $staticRoutes = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('audit.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('blog.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('contact.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('seo.shopee'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('seo.tokopedia'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('seo.online-shop'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('seo.umkm'), 'priority' => '0.8', 'changefreq' => 'weekly'],
        ];

        foreach ($staticRoutes as $route) {
            $urls[] = [
                'loc' => $route['url'],
                'lastmod' => now()->toAtomString(),
                'changefreq' => $route['changefreq'],
                'priority' => $route['priority'],
            ];
        }

        // Dynamic Published Articles
        try {
            $articles = Article::published()->latest('updated_at')->get();
            foreach ($articles as $article) {
                $urls[] = [
                    'loc' => route('blog.show', $article->slug),
                    'lastmod' => ($article->updated_at ?? $article->published_at ?? now())->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }
        } catch (\Exception $e) {
            // Fallback if DB query fails
        }

        // Dynamic Categories
        try {
            $categories = Category::has('articles')->get();
            foreach ($categories as $cat) {
                $urls[] = [
                    'loc' => route('blog.category', $cat->slug),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            }
        } catch (\Exception $e) {
            // Fallback if DB query fails
        }

        // Dynamic Programs
        try {
            $programs = Program::all();
            foreach ($programs as $prog) {
                $urls[] = [
                    'loc' => route('program.show', $prog->slug),
                    'lastmod' => ($prog->updated_at ?? now())->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }
        } catch (\Exception $e) {
            // Fallback if DB query fails
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}
