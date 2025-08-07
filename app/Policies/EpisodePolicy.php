<?php

namespace App\Policies;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EpisodePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }
    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, Episode $episode)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, Episode $episode)
    {
        return $user->role->name === 'admin';
    }
}
