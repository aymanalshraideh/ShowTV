<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TvShow;

class TvShowPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, TvShow $tvShow)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, TvShow $tvShow)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, TvShow $tvShow)
    {
        return $user->role->name === 'admin';
    }
}
