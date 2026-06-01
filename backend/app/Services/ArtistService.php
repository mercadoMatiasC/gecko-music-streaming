<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Artist;
use App\Models\User;

class ArtistService {
    //-- STORE --
    public function ensureArtistCanBeStored(string $name) {
        $existing = Artist::where('name', $name)->exists();

        if ($existing)
            throw new BusinessException("There's already an artist under that name.");
    }

    public function storeArtist(User $auth_user, array $data) {
        $this->ensureArtistCanBeStored($data['name']);

        return Artist::create([
            "uploader_id" => $auth_user->id,
            "name" => $data['name'],
            "artist_image_route" => $data['artist_image_route'],
        ]);
    }

    //-- UPDATE -- 
    public function ensureArtistCanBeUpdated(User $auth_user, Artist $artist, array $data) {
        if ($artist->uploader->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to update this resource.");

        $existing = Artist::where('id', '!=', $artist->id)->where('name', $data['name'])->exists();

        if ($existing)
            throw new BusinessException("There's already an artist under that name.");
    }

    public function updateArtist(User $auth_user, Artist $artist, array $data) {
        $this->ensureArtistCanBeUpdated($auth_user, $artist, $data);
        $artist->update($data);
        $artist->refresh();

        return $artist;
    }

    //-- DELETE --
    public function ensureArtistCanBeDeleted(User $auth_user, Artist $artist) {
        if ($artist->uploader->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to delete this resource.");

        if ($artist->albums()->exists() || $artist->songs()->exists())
            throw new BusinessException("Cannot delete this artist because they have associated albums or songs.");
    }

    public function removeArtist(User $auth_user, Artist $artist) {
        $this->ensureArtistCanBeDeleted($auth_user, $artist);

        return $artist->delete();
    }
}