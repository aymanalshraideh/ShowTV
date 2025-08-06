<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\EpisodeService;
use App\Services\TvShowService;

class HomeController extends Controller
{
    protected $episodeService;
    protected $tvShowService;

    public function __construct(EpisodeService $episodeService, TvShowService $tvShowService)
    {
        $this->episodeService = $episodeService;
        $this->tvShowService  = $tvShowService;
    }

    public function index()
    {
        $episodes = $this->episodeService->getLastEpisodes(20);
        $tvShows  = $this->tvShowService->getAllTvShows(10);

        return view('home.index', compact('episodes', 'tvShows'));
    }
}
