<?php

use App\Http\Controllers\GitHubLoginController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/', [UrlShortenerController::class, 'getShortUrl'])->name('get-short-url');

require __DIR__.'/auth.php';

Route::get('/auth/redirect', [GitHubLoginController::class, 'redirectGitHub'])
    ->name('redirectGitHub');

Route::get('/auth/callback', [GitHubLoginController::class, 'callbackGitHub']);

Route::get('/{key}', [UrlShortenerController::class, 'redirect']);

