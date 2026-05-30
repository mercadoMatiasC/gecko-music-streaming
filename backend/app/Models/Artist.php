<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model {
    protected $fillable = [
        'uploader_id',
        'name',
        'artist_image_route'
    ];
}
