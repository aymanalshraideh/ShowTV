<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\TvShow;
use App\Models\Episode;
use App\Policies\TvShowPolicy;
use App\Policies\EpisodePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        TvShow::class => TvShowPolicy::class,
        Episode::class => EpisodePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', function (User $user) {
            return $user->role->name === 'admin';
        });
    }
}
