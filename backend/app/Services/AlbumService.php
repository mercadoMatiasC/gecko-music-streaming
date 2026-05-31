<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Album;
use App\Models\Artist;
use App\Models\User;

class AlbumService {
    //-- STORE --
    public function ensureAlbumCanBeStored(array $data, Artist $artist) {
        $existing = Album::where('artist_id', $artist->id)->where('title', $data['title'])->exists();

        if ($existing)
            throw new BusinessException("There's already an album with that name under that artist.");
    }

    public function storeAlbum(User $auth_user, Artist $artist, array $data) {
        $this->ensureAlbumCanBeStored($data, $artist);

        return $artist->albums()->create([
            "uploader_id" => $auth_user->id,
            "artist_id" => $artist->id,
            "title" => $data["title"],
            "album_image_route" => $data['album_image_route'],
            "date_released" => $data['date_released'],
        ]);
    }

    //-- UPDATE -- 
    public function ensureAlbumCanBeUpdated(User $auth_user, Album $album, array $data) {
        if (($auth_user->id != $album->uploader_id) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to update this resource.");

        $existing = Album::where('id', '!=', $album->id)
        ->where('artist_id', $album->artist_id)
        ->where('title', $data['title'])->exists();

        if ($existing)
            throw new BusinessException("There's already an album with that name under that artist.");
    }

    public function updateAlbum(User $auth_user, Album $album, array $data) {
        $this->ensureAlbumCanBeUpdated($auth_user, $album, $data);
        $album->update($data);
        $album->refresh();

        return $album;
    }

    //-- DELETE --
    public function ensureAlbumCanBeDeleted(User $auth_user, Album $album) {
        if (($auth_user->id != $album->uploader_id) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to delete this resource.");

        if ($album->songs()->exists())
            throw new BusinessException("Cannot delete this album because they have associated songs.");
    }

    public function removeAlbum(User $auth_user, Album $album) {
        $this->ensureAlbumCanBeDeleted($auth_user, $album);

        return $album->delete();
    }
}