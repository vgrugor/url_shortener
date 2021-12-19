<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GitHubLoginController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UrlManagingController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';
Auth::routes();

Route::get('/auth/redirect', [GitHubLoginController::class, 'redirectGitHub'])
    ->name('redirectGitHub');

Route::get('/auth/callback', [GitHubLoginController::class, 'callbackGitHub']);

Route::middleware('auth')->group(function () {
    Route::post('/', [UrlShortenerController::class, 'getShortUrl'])
        ->name('get-short-url');

    Route::get('/', [UrlShortenerController::class, 'index'])
        ->name('dashboard');

    Route::get('/managing-urls', [UrlManagingController::class, 'index'])
        ->name('managing-urls');

    Route::get('/destroy/{shortKey}', [UrlManagingController::class, 'destroy'])
        ->name('destroy');
});

Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin'])->name('admin');

Route::middleware(['urlExists', 'statisticsVisited'])->group(function () {
    Route::get('/{shortKey}', [RedirectController::class, 'redirect']);

    Route::get('/{shortKey}/{secretKey}', [RedirectController::class, 'secretRedirect']);
});

