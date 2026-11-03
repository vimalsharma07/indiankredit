<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');

Route::get('/command/{task}', function (string $task) {
    Artisan::call(...match ($task) {
        'migrate' => ['migrate', ['--force' => true]],
        'optimize' => ['optimize:clear', []],
    });

    return response(Artisan::output(), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
})->whereIn('task', ['migrate', 'optimize']);

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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:8,1')->name('register.store');

    Route::get('/verify-email', [AuthController::class, 'showVerify'])->name('verify');
    Route::post('/verify-email', [AuthController::class, 'verify'])->middleware('throttle:8,1')->name('verify.store');
    Route::post('/verify-email/resend', [AuthController::class, 'resend'])->middleware('throttle:5,1')->name('verify.resend');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:8,1')->name('login.store');

    Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.forgot');
    Route::post('/forgot-password', [AuthController::class, 'sendReset'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->middleware('throttle:8,1')->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/account', [ProfileSetupController::class, 'show'])->name('profile.setup');
    Route::post('/account', [ProfileSetupController::class, 'save'])->middleware('throttle:10,1')->name('profile.save');
    Route::post('/account/skip', [ProfileSetupController::class, 'skip'])->name('profile.skip');
});
