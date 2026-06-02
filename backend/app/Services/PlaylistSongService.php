<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;

class PlaylistSongService {
    public function ensurePlaylistCanAddSong(User $auth_user, Playlist $playlist, Song $song) {
        if ($playlist->owner->isNot($auth_user))
            throw new BusinessException("You cannot add songs to a playlist that's not yours.");

        $existing = $playlist->songs()->where('song_id', $song->id)->exists();

        if ($existing)
            throw new BusinessException('"'.$song->title.'" is already in "'.$playlist->title.'".');
    }

    public function storePlaylistSong(User $auth_user, Playlist $playlist, Song $song) {
        $this->ensurePlaylistCanAddSong($auth_user, $playlist, $song);
        $playlist->songs()->attach($song->id);
        
        return true;
    }

    public function ensurePlaylistCanRemoveSong(User $auth_user, Playlist $playlist, Song $song) {
        if ($playlist->owner->isNot($auth_user))
            throw new BusinessException("You cannot remove songs from a playlist that's not yours.");

        $existing = $playlist->songs()->where('song_id', $song->id)->exists();

        if (!$existing)
            throw new BusinessException('"'.$song->title.'" is not in "'.$playlist->title.'".');
    }

    public function removePlaylistSong(User $auth_user, Playlist $playlist, Song $song) {
        $this->ensurePlaylistCanRemoveSong($auth_user, $playlist, $song);
        $playlist->songs()->detach($song->id);

        return true;
    }
}