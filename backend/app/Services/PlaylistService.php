<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Playlist;
use App\Models\User;

class PlaylistService {
    //-- STORE --
    public function ensurePlaylistCanBeStored(User $auth_user, array $data) {
        $existing = $auth_user->playlists()->where('title', $data['title'])->exists();

        if ($existing)
            throw new BusinessException("You already have a playlist with the same name.");
    }

    public function storePlaylist(User $auth_user, array $data) {
        $this->ensurePlaylistCanBeStored($auth_user, $data);

        return $auth_user->playlists()->create([
            "title" => $data['title'],
            "playlist_image_route" => $data['playlist_image_route'] ?? null,
        ]);
    }

    //-- UPDATE -- 
    public function ensurePlaylistCanBeUpdated(User $auth_user, Playlist $playlist, array $data) {
        if ($playlist->owner->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to update this resource.");

        $existing = $playlist->owner->playlists()
            ->where('id', '!=', $playlist->id)
            ->where('title', $data['title'])
            ->exists();

        if ($existing)
            throw new BusinessException("The owner already has a playlist with the same name.");
    }

    public function updatePlaylist(User $auth_user, Playlist $playlist, array $data) {
        $this->ensurePlaylistCanBeUpdated($auth_user, $playlist, $data);
        $playlist->update($data);
        $playlist->refresh();

        return $playlist;
    }

    //-- DELETE --
    public function ensurePlaylistCanBeDeleted(User $auth_user, Playlist $playlist) {
        if ($playlist->owner->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to delete this resource.");
    }

    public function removePlaylist(User $auth_user, Playlist $playlist) {
        $this->ensurePlaylistCanBeDeleted($auth_user, $playlist);

        return $playlist->delete();
    }
}