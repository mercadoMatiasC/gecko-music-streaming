<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}