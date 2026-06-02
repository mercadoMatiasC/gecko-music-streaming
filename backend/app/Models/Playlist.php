<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model {
    protected $fillable = [
        'owner_id',
        'title',
        'playlist_image_route',
    ];

    //RELATIONSHIPS
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function songs(): BelongsToMany {
        return $this->belongsToMany(Song::class, 'playlist_songs', 'playlist_id', 'song_id')->withTimestamps();
    }
}