<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandingManagerController;
use App\Http\Controllers\Admin\ProgramManagerController;
use App\Http\Controllers\Admin\PortfolioManagerController;
use App\Http\Controllers\Admin\BlogManagerController;
use App\Http\Controllers\Admin\FaqManagerController;
use App\Http\Controllers\Admin\TestimonialManagerController;
use App\Http\Controllers\Admin\LeadManagerController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\WebsiteSettingsController;
use App\Http\Controllers\Admin\LegalManagerController;

/*
|--------------------------------------------------------------------------
| ADMIN / CMS ROUTES — Trinova Digital
| Semua route di sini dilindungi middleware: auth + role:admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Landing Manager
        Route::prefix('landing')->name('landing.')->group(function () {
            Route::get('/', [LandingManagerController::class, 'index'])->name('index');
            Route::put('/', [LandingManagerController::class, 'update'])->name('update');
        });

        // Program Manager
        Route::prefix('program')->name('program.')->group(function () {
            Route::get('/', [ProgramManagerController::class, 'index'])->name('index');
            Route::get('/create', [ProgramManagerController::class, 'create'])->name('create');
            Route::post('/', [ProgramManagerController::class, 'store'])->name('store');
            Route::get('/{program}/edit', [ProgramManagerController::class, 'edit'])->name('edit');
            Route::put('/{program}', [ProgramManagerController::class, 'update'])->name('update');
            Route::put('/{program}/topics', [ProgramManagerController::class, 'updateTopics'])->name('update-topics');
            Route::delete('/{program}', [ProgramManagerController::class, 'destroy'])->name('destroy');
            Route::post('/{program}/best-value', [ProgramManagerController::class, 'toggleBestValue'])->name('toggle-best-value');
        });

        // Portfolio Manager
        Route::prefix('portfolio')->name('portfolio.')->group(function () {
            Route::get('/', [PortfolioManagerController::class, 'index'])->name('index');
            Route::get('/create', [PortfolioManagerController::class, 'create'])->name('create');
            Route::post('/', [PortfolioManagerController::class, 'store'])->name('store');
            Route::get('/{portfolio}/edit', [PortfolioManagerController::class, 'edit'])->name('edit');
            Route::put('/{portfolio}', [PortfolioManagerController::class, 'update'])->name('update');
            Route::delete('/{portfolio}', [PortfolioManagerController::class, 'destroy'])->name('destroy');
        });

        // Blog Manager
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogManagerController::class, 'index'])->name('index');
            Route::post('/bulk-delete', [BlogManagerController::class, 'bulkDelete'])->name('bulk-delete');
            Route::post('/{article}/duplicate', [BlogManagerController::class, 'duplicate'])->name('duplicate');
            Route::get('/create', [BlogManagerController::class, 'create'])->name('create');
            Route::post('/', [BlogManagerController::class, 'store'])->name('store');
            Route::get('/{article}/edit', [BlogManagerController::class, 'edit'])->name('edit');
            Route::put('/{article}', [BlogManagerController::class, 'update'])->name('update');
            Route::delete('/{article}', [BlogManagerController::class, 'destroy'])->name('destroy');
            // Category & Tag
            Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
            Route::resource('tags', \App\Http\Controllers\Admin\TagController::class)->except(['show']);
        });

        // FAQ Manager
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('/', [FaqManagerController::class, 'index'])->name('index');
            Route::post('/', [FaqManagerController::class, 'store'])->name('store');
            Route::put('/{faq}', [FaqManagerController::class, 'update'])->name('update');
            Route::delete('/{faq}', [FaqManagerController::class, 'destroy'])->name('destroy');
        });

        // Testimonial Manager
        Route::prefix('testimonial')->name('testimonial.')->group(function () {
            Route::get('/', [TestimonialManagerController::class, 'index'])->name('index');
            Route::post('/', [TestimonialManagerController::class, 'store'])->name('store');
            Route::put('/{testimonial}', [TestimonialManagerController::class, 'update'])->name('update');
            Route::delete('/{testimonial}', [TestimonialManagerController::class, 'destroy'])->name('destroy');
        });

        // Lead Manager
        Route::prefix('leads')->name('leads.')->group(function () {
            Route::get('/', [LeadManagerController::class, 'index'])->name('index');
            Route::get('/{lead}', [LeadManagerController::class, 'show'])->name('show');
            Route::put('/{lead}', [LeadManagerController::class, 'update'])->name('update');
            Route::put('/{lead}/status', [LeadManagerController::class, 'updateStatus'])->name('status');
            Route::put('/{lead}/update-status', [LeadManagerController::class, 'updateStatus'])->name('updateStatus');
            Route::post('/{lead}/activity', [LeadManagerController::class, 'addActivity'])->name('activity');
            Route::delete('/{lead}', [LeadManagerController::class, 'destroy'])->name('destroy');
        });

        // Media Library
        Route::prefix('media')->name('media.')->group(function () {
            Route::get('/', [MediaLibraryController::class, 'index'])->name('index');
            Route::post('/', [MediaLibraryController::class, 'store'])->name('store');
            Route::delete('/{media}', [MediaLibraryController::class, 'destroy'])->name('destroy');
        });

        // Website Settings
        Route::get('/settings', [WebsiteSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [WebsiteSettingsController::class, 'update'])->name('settings.update');

        // Legal Manager (Syarat & Ketentuan)
        Route::prefix('legal')->name('legal.')->group(function () {
            Route::get('/', [LegalManagerController::class, 'index'])->name('index');
            Route::post('/document', [LegalManagerController::class, 'updateDocument'])->name('document.update');
            Route::post('/document/publish', [LegalManagerController::class, 'publish'])->name('document.publish');
            Route::post('/sections', [LegalManagerController::class, 'storeSection'])->name('sections.store');
            Route::put('/sections/{section}', [LegalManagerController::class, 'updateSection'])->name('sections.update');
            Route::delete('/sections/{section}', [LegalManagerController::class, 'destroySection'])->name('sections.destroy');
        });
    });
