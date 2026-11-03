<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');

foreach (array_keys(config('site.products')) as $slug) {
    Route::get('/'.$slug, [SiteController::class, 'product'])->defaults('key', $slug)->name($slug);
}

Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/standards', [SiteController::class, 'standards'])->name('standards');
Route::get('/careers', [SiteController::class, 'careers'])->name('careers');
Route::get('/faq', [SiteController::class, 'faq'])->name('faq');
Route::get('/credit-score', [SiteController::class, 'creditScore'])->name('credit-score');
Route::get('/corporate', [SiteController::class, 'corporate'])->name('corporate');
Route::get('/refer', [SiteController::class, 'refer'])->name('refer');
Route::get('/sitemap', [SiteController::class, 'sitemap'])->name('sitemap');

Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [SiteController::class, 'blogShow'])->name('blog.show');

Route::get('/calculators', [SiteController::class, 'calculators'])->name('calculators');
Route::get('/calculators/{slug}', [SiteController::class, 'calculator'])->name('calculators.show');

Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'contactSubmit'])->middleware('throttle:20,1')->name('contact.submit');

Route::get('/apply', [SiteController::class, 'apply'])->name('apply');
Route::post('/apply', [SiteController::class, 'applySubmit'])->middleware('throttle:20,1')->name('apply.submit');

Route::get('/repayment', [SiteController::class, 'repayment'])->name('repayment');
Route::post('/repayment', [SiteController::class, 'repaymentSubmit'])->middleware('throttle:20,1')->name('repayment.submit');

foreach (['terms', 'privacy', 'grievance', 'fraud-safety'] as $page) {
    Route::get('/'.$page, [SiteController::class, 'legal'])->defaults('page', $page)->name($page);
}
