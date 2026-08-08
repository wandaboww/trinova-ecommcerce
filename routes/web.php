<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES — Trinova Digital
|--------------------------------------------------------------------------
*/

// Landing Page (Home)
Route::get('/', [LandingController::class, 'index'])->name('home');

// Analisa Bisnis Gratis
Route::get('/analisa-bisnis-gratis', [AuditController::class, 'index'])->name('audit.index');
Route::post('/analisa-bisnis-gratis', [AuditController::class, 'store'])->name('audit.store');
Route::get('/analisa-bisnis-gratis/terima-kasih', [AuditController::class, 'success'])->name('audit.success');

// Program Layanan
Route::redirect('/program', '/#program')->name('program.index');
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');

// Portfolio
Route::redirect('/portfolio', '/#portfolio')->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/kategori/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{article:slug}', [BlogController::class, 'show'])->name('blog.show');

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Sitemap XML
use App\Http\Controllers\SitemapController;
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// SEO Pages (halaman landing khusus keyword)
Route::get('/website-untuk-seller-shopee', [LandingController::class, 'seoShopee'])->name('seo.shopee');
Route::get('/website-untuk-seller-tokopedia', [LandingController::class, 'seoTokopedia'])->name('seo.tokopedia');
Route::get('/website-untuk-online-shop', [LandingController::class, 'seoOnlineShop'])->name('seo.online-shop');
Route::get('/website-untuk-umkm', [LandingController::class, 'seoUmkm'])->name('seo.umkm');

// Legal Pages
Route::get('/kebijakan-privasi', [LandingController::class, 'privacy'])->name('privacy');

// Authentication Routes
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Load Admin/CMS Routes
require __DIR__ . '/admin.php';
