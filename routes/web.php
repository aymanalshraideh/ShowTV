<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\TvShowController;
use App\Http\Controllers\Frontend\TvShowController as TvShowFE;
use App\Http\Controllers\Frontend\EpisodeController as EpisodeFE;
use App\Http\Controllers\Backend\EpisodeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Models\TvShow;
use App\Models\User;

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

    Route::post('tvshows/{id}/follow', [TvShowController::class, 'follow'])->name('tvshows.follow');


    Route::post('episodes/{id}/like', [EpisodeController::class, 'like']);
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard.home.index');
    })->name('dashboard');


    Route::get('/users', function () {

        $users = User::with('role')->paginate(10);
        return view('dashboard.users.index', compact('users'));
    })->name('admin.users.index');


    Route::get('/tv-shows', function () {
        return view('dashboard.tvshows.index');
    })->name('tv-shows');


    Route::get('/episodess', function () {
        $tvshows = TvShow::all();
        return view('dashboard.episodes.index', compact('tvshows'));
    })->name('episodess-page');


    Route::resource('tvshows', TvShowController::class)->names('tvsh');


    Route::resource('episodes', EpisodeController::class)->names('epis');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
