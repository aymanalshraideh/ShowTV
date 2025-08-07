<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TvShow;

class TvShowSeeder extends Seeder
{
    public function run()
    {
        $shows = [
            ['title' => 'Breaking Code', 'description' => 'A drama about developers and debugging.', 'airing_time' => 'Monday-Thursday @ 8:30PM', 'thumbnail' => 'frontend-asset/img/gallery/project-1.jpg', 'type' => 'Series'],
            ['title' => 'Laravel Legends', 'description' => 'The journey of coders mastering Laravel.', 'airing_time' => 'Friday @ 9:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-2.jpg', 'type' => 'TV Show'],
            ['title' => 'Tech Titans', 'description' => 'The rise of tech entrepreneurs.', 'airing_time' => 'Saturday @ 7:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-3.jpg', 'type' => 'TV Show'],
            ['title' => 'Debugging Diaries', 'description' => 'Inside stories of software bugs.', 'airing_time' => 'Sunday @ 6:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-4.jpg', 'type' => 'Series'],
            ['title' => 'Code Warriors', 'description' => 'Battles in the coding world.', 'airing_time' => 'Wednesday @ 8:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-5.jpg', 'type' => 'Series'],
            ['title' => 'API Avengers', 'description' => 'Heroes of the backend.', 'airing_time' => 'Tuesday @ 9:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-6.jpg', 'type' => 'TV Show'],
            ['title' => 'Frontend Frenzy', 'description' => 'Designing the web.', 'airing_time' => 'Thursday @ 7:30PM', 'thumbnail' => 'frontend-asset/img/gallery/project-1.jpg', 'type' => 'Series'],
            ['title' => 'Database Depths', 'description' => 'The secrets of data.', 'airing_time' => 'Monday @ 10:00PM', 'thumbnail' => 'frontend-asset/img/gallery/project-2.jpg', 'type' => 'TV Show'],
            ['title' => 'Cloud Chronicles', 'description' => 'Adventures in the cloud.', 'airing_time' => 'Friday @ 6:30PM', 'thumbnail' => 'frontend-asset/img/gallery/project-3.jpg', 'type' => 'Series'],
            ['title' => 'Script Saga', 'description' => 'Script kiddies growing up.', 'airing_time' => 'Saturday @ 8:45PM', 'thumbnail' => 'frontend-asset/img/gallery/project-4.jpg', 'type' => 'TV Show'],
        ];

        foreach ($shows as $show) {
            TvShow::create($show);
        }
    }
}
