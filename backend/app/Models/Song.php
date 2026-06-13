<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {
    protected $fillable = [
        'uploader_id',
        'album_id',
        'artist_id',
        'title',
        'play_count',
        'file_route'
    ];

    //RELATIONSHIPS
    public function uploader(){
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function artist(){
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function reports() {
        return $this->morphMany(Report::class, 'reportable');
    }
}