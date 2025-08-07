<?php

namespace App\Http\Controllers\Backend;

use App\Models\TvShow;
use Illuminate\Http\Request;
use App\Services\TvShowService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTvShowRequest;

class TvShowController extends Controller
{
    protected $tvShowService;

    public function __construct(TvShowService $tvShowService)
    {
        $this->tvShowService = $tvShowService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', TvShow::class);

        $perPage = $request->query('per_page', 10);
        $search = $request->query('search', '');

        $tvShows = $this->tvShowService->getPaginatedTvShows($perPage, $search);
        return response()->json($tvShows);
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
    public function store(StoreTvShowRequest $request)
    {
        $this->authorize('create', TvShow::class);

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        return response()->json($this->tvShowService->createShow($data));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('view', TvShow::findOrFail($id));
        return response()->json($this->tvShowService->tvShowRepo->find($id));
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
    public function update(UpdateTvShowRequest $request, $id)
    {
        $this->authorize('update', TvShow::findOrFail($id));

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        return response()->json($this->tvShowService->updateShow($id, $data));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', TvShow::findOrFail($id));
        return response()->json($this->tvShowService->deleteShow($id));
    }
    public function follow($id)
    {
        $status = $this->tvShowService->toggleFollow($id, Auth::id());

        return response()->json([
            'status' => $status ? 'followed' : 'unfollowed'
        ]);
    }
}
