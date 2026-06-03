<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model {
    public const REACTION_NONE    = 0;
    public const REACTION_LIKE    = 1;
    public const REACTION_DISLIKE = 2;

    public const REACTION_STATUSES = [self::REACTION_NONE, self::REACTION_LIKE, self::REACTION_DISLIKE];

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

    public function reactions(): BelongsToMany {
        return $this->belongsToMany(User::class, 'playlist_reactions', 'playlist_id', 'user_id')->withPivot('like_status', 'saved_by_user')->withTimestamps();
    }
}