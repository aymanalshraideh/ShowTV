<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'tv_show_id', 'title', 'description', 'duration', 'airing_time', 'thumbnail', 'video_url'
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
