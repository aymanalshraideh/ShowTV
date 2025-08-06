<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Episode;
use App\Models\TvShow;

class EpisodeSeeder extends Seeder
{
    public function run()
    {
        $totalTvShows = 10;

        for ($tvShowId = 1; $tvShowId <= $totalTvShows; $tvShowId++) {
            for ($episodeNumber = 1; $episodeNumber <= 30; $episodeNumber++) {
                $tvshow = TvShow::find($tvShowId)->title;

                Episode::factory()->create([
                    'tv_show_id' => $tvShowId,
                    'description' => "Description for episode $episodeNumber of TV Show $tvshow.",
                    'video_url' => "video{$tvShowId}_{$episodeNumber}.mp4",
                ]);
            }
        }
    }
}
