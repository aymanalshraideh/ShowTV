<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\TvShowService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $this->authorize('viewAny', TvShow::class);
        return response()->json($this->tvShowService->tvShowRepo->all());
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
        $this->authorize('create', TvShow::class);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'airing_time' => 'required|string'
        ]);

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
    public function update(Request $request, $id)
    {
        $this->authorize('update', TvShow::findOrFail($id));

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'airing_time' => 'required|string'
        ]);

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
