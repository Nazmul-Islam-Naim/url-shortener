<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UrlShortenerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('urlShorteners/store', [UrlShortenerController::class, 'store'])->name('urlShorteners.store');
    Route::get('urlShorteners/clickCount/{urlShortener}', [UrlShortenerController::class, 'clickCount'])->name('urlShorteners.clickCount');
    Route::get('urlPath/{shortPath}', [UrlShortenerController::class, 'redirectShortToLongPath']);
});

require __DIR__.'/auth.php';
