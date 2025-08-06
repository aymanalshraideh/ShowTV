<?php

namespace App\Http\Controllers\Backend;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Services\EpisodeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EpisodeController extends Controller
{
    protected $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Episode::class);
        return response()->json($this->episodeService->episodeRepo->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Episode::class);

        $data = $request->validate([
            'tv_show_id' => 'required|exists:tv_shows,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'airing_time' => 'required|string',
            'thumbnail' => 'nullable|string',
            'video_url' => 'required|string'
        ]);

        return response()->json($this->episodeService->createEpisode($data));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('view', Episode::findOrFail($id));
        return response()->json($this->episodeService->episodeRepo->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Episode::findOrFail($id));

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'airing_time' => 'required|string',
            'thumbnail' => 'nullable|string',
            'video_url' => 'required|string'
        ]);

        return response()->json($this->episodeService->updateEpisode($id, $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Episode::findOrFail($id));
        return response()->json($this->episodeService->deleteEpisode($id));
    }
    public function like($id)
    {
        $status = $this->episodeService->toggleLike($id, Auth::id());

        return response()->json([
            'status' => $status ? 'like' : 'unlike'
        ]);
    }
}
