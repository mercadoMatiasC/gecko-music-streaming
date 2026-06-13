<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model {
    protected $fillable = [
        'uploader_id',
        'name',
        'artist_image_route'
    ];

    //RELATIONSHIPS
    public function uploader(){
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function albums() {
        return $this->hasMany(Album::class);
    }

    public function songs(){
        return $this->hasMany(Song::class);
    }

    public function reports() {
        return $this->morphMany(Report::class, 'reportable');
    }
}
