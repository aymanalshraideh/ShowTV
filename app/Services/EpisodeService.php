<?php

namespace App\Services;

use App\Repositories\EpisodeRepository;
use App\Models\User;

class EpisodeService
{
    protected $episodeRepo;

    public function __construct(EpisodeRepository $episodeRepo)
    {
        $this->episodeRepo = $episodeRepo;
    }

    public function likeEpisode($episodeId, $userId)
    {
        $user = User::findOrFail($userId);
        $user->likes()->toggle($episodeId);
        return ['status' => 'success', 'message' => 'Like status updated'];
    }
    public function getEpisodeById($id)
    {
        return $this->episodeRepo->find($id);
    }
    public function createEpisode(array $data)
    {
        return $this->episodeRepo->create($data);
    }

    public function updateEpisode($id, array $data)
    {
        return $this->episodeRepo->update($id, $data);
    }

    public function deleteEpisode($id)
    {
        return $this->episodeRepo->delete($id);
    }
    public function searchEpisodes($query)
    {
        return $this->episodeRepo->search($query);
    }
    public function getLastEpisodes($limit = 30)
    {
        return $this->episodeRepo->getLastEpisodes($limit);
    }
}
