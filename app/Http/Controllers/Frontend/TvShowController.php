<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\TvShowService;

class TvShowController extends Controller
{
    protected $tvShowService;

    public function __construct(TvShowService $tvShowService)
    {
        $this->tvShowService = $tvShowService;
    }

    public function index($id)
    {
        $tvShow = $this->tvShowService->getTvShowWithEpisodes($id);
        // dd($tvShow);
        return view('tvshows.index', compact('tvShow'));
    }
}
