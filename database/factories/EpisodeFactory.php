<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), 
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(40, 60) . ' min',
            'airing_time' => $this->faker->dayOfWeek . ' @ 8:30PM',
            'thumbnail' => 'frontend-asset/img/covers/cover' . $this->faker->numberBetween(1, 6) . '.jpg',
            'video_url' => $this->faker->word . '.mp4',
        ];
    }
}
