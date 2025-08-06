<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Services\TvShowService;
use App\Services\EpisodeService;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    protected $episodeService;
    protected $tvShowService;

    public function __construct(EpisodeService $episodeService, TvShowService $tvShowService)
    {
        $this->episodeService = $episodeService;
        $this->tvShowService  = $tvShowService;
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json(['episodes' => [], 'tv_shows' => []]);
        }

        $episodes = $this->episodeService->searchEpisodes($query);
        $tvShows  = $this->tvShowService->searchTvShows($query);

        return response()->json([
            'episodes' => $episodes,
            'tv_shows' => $tvShows
        ]);
    }
}
