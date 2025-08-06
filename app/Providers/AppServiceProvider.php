<?php

namespace App\Providers;

use App\Models\TvShow;
use App\Models\Episode;
use App\Observers\EpisodeObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Episode::observe(EpisodeObserver::class);
        // Share all tv shows with all views
        $tvShowsNav = TvShow::inRandomOrder()->take(5)->get();

        View::share('tvShowsNav', $tvShowsNav);
    }
}
