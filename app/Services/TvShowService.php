<?php

namespace App\Services;

use App\Repositories\TvShowRepository;
use App\Models\User;

class TvShowService
{
    protected $tvShowRepo;

    public function __construct(TvShowRepository $tvShowRepo)
    {
        $this->tvShowRepo = $tvShowRepo;
    }

    public function toggleFollow($tvShowId, $userId)
    {
        return $this->tvShowRepo->toggleFollow($tvShowId, $userId);
    }
    public function getAllTvShows($limit = 10)
    {
        return $this->tvShowRepo->getLastTvShows($limit);
    }
    public function getTvShowWithEpisodes($id)
    {
        return $this->tvShowRepo->find($id);
    }
    public function createShow(array $data)
    {
        return $this->tvShowRepo->create($data);
    }

    public function updateShow($id, array $data)
    {
        return $this->tvShowRepo->update($id, $data);
    }

    public function deleteShow($id)
    {
        return $this->tvShowRepo->delete($id);
    }
    public function searchTvShows($query)
    {
        return $this->tvShowRepo->search($query);
    }
}
