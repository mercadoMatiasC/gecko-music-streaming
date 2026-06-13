<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model {
    public const REPORTABLES = ['playlist', 'song', 'album', 'artist'];

    public const REPORTABLE_MAP = [
        'playlist' => Playlist::class,
        'song'     => Song::class,
        'album'    => Album::class,
        'artist'   => Artist::class,
    ];

    protected $fillable = [
        'reporter_id',
        'details_body',
    ];

    //RELATIONSHIPS
    public function reportable() {
        return $this->morphTo();
    }

    public function reporter(): BelongsTo {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}