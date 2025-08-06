<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\TvShowController;
use App\Http\Controllers\Frontend\TvShowController as TvShowFE;
use App\Http\Controllers\Frontend\EpisodeController as EpisodeFE;
use App\Http\Controllers\Backend\EpisodeController;
use App\Http\Controllers\Frontend\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tvshows/{id}', [TvShowFE::class, 'index'])->name('tvshows.show');
Route::get('/episodes/{id}', [EpisodeFE::class, 'show'])->name('episodes.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::middleware(['auth'])->group(function () {
    Route::resource('tvshows', TvShowController::class);
 Route::post('tvshows/{id}/follow', [TvShowController::class, 'follow'])->name('tvshows.follow');

    Route::resource('episodes', EpisodeController::class);
    Route::post('episodes/{id}/like', [EpisodeController::class, 'like']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
