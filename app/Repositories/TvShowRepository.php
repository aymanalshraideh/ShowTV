<?php

namespace App\Repositories;

use App\Models\TvShow;

class TvShowRepository
{
    public function all()
    {
        return TvShow::with('episodes')->get();
    }
    public function getLastTvShows($limit=10)
    {
        return TvShow::latest()->take($limit)->get();
    }
    public function find($id)
    {
        return TvShow::with('episodes')->findOrFail($id);
    }

    public function create(array $data)
    {
        return TvShow::create($data);
    }

    public function update($id, array $data)
    {
        $tvShow = TvShow::findOrFail($id);
        $tvShow->update($data);
        return $tvShow;
    }

    public function delete($id)
    {
        return TvShow::destroy($id);
    }
    public function search($query)
    {
        return TvShow::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(10)
            ->get();
    }
}
