<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model {
    protected $fillable = [
        'host_id',
        'playlist_id',
        'current_song_id',
        'is_paused',
        'sync_timestamp',
        'sync_assigned_at'
    ];

    protected $casts = [
        'is_paused' => 'boolean',
        'sync_timestamp' => 'float',
        'sync_assigned_at' => 'datetime',
    ];

    //RELATIONSHIPS
    public function host(){
        return $this->belongsTo(User::class, 'host_id');
    }

    public function currentPlaylist(){
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }

    public function currentSong(){
        return $this->belongsTo(Song::class, 'current_song_id');
    }
}