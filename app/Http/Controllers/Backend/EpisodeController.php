<?php

namespace App\Http\Controllers\Backend;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Services\EpisodeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;

class EpisodeController extends Controller
{
    protected $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Episode::class);

        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $episodes = $this->episodeService->getPaginatedEpisodes($perPage, $search);

        return response()->json($episodes);
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
    public function store(StoreEpisodeRequest $request)
    {
        $this->authorize('create', Episode::class);

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

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
    public function update(UpdateEpisodeRequest $request, $id)
    {
        $this->authorize('update', Episode::findOrFail($id));

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

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
