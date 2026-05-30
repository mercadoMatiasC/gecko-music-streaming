<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {
    protected $fillable = [
        'uploader_id',
        'artist_id',
        'title',
        'album_image_route',
        'date_released'
    ];

    //RELATIONSHIPS
    public function uploader(){
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function artist(){
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    /*
    public function songs(){
        return $this->hasMany(Song::class);
    }
    */
}