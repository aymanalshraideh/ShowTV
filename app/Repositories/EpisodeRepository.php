<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Episode;

class EpisodeRepository
{
    public function all()
    {
        return Episode::with('tvShow')->latest()->get();
    }
    public function paginate($perPage = 10, $search = '')
    {
        $query = Episode::with('tvShow');

        if (!empty($search)) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('tvShow', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
        }

        return $query->latest()->paginate($perPage);
    }

    public function find($id)
    {
        return Episode::with('tvShow')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Episode::create($data);
    }

    public function update($id, array $data)
    {
        $episode = Episode::findOrFail($id);
        $episode->update($data);
        return $episode;
    }

    public function delete($id)
    {
        return Episode::destroy($id);
    }
    public function search($query)
    {
        return Episode::with('tvShow')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(10)
            ->get();
    }
    public function getLastEpisodes($limit = 30)
    {
        return Episode::with('tvShow')
            ->latest()
            ->take($limit)
            ->get();
    }
    public function toggleLike($episodeId, $userId)
    {
        $user = User::findOrFail($userId);
        $user->likes()->toggle($episodeId);

        return $user->likes->contains($episodeId);
    }
}
