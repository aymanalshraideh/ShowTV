<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\EpisodeService;

class EpisodeController extends Controller
{
    protected $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function show($id)
    {
        $episode = $this->episodeService->getEpisodeById($id);
        return view('episodes.index', compact('episode'));
    }
}
