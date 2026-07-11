<?php

use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
| Static, cacheable corporate pages. SEO-friendly slugs; every route is
| named so views, sitemap and breadcrumbs never hardcode a URL.
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/manufacturing-services', [PageController::class, 'services'])->name('services');
Route::get('/manufacturing-services/{service}', [PageController::class, 'service'])->name('services.show');
Route::get('/capabilities', [PageController::class, 'capabilities'])->name('capabilities');
Route::get('/industries', [PageController::class, 'industries'])->name('industries');
Route::get('/why-choose-us', [PageController::class, 'whyChooseUs'])->name('why');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Inquiry form — CSRF (web group) + honeypot (request) + rate limit.
Route::post('/contact', [InquiryController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('inquiry.store');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
