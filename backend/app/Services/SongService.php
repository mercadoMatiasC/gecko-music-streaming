<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SongService {
    //-- STORE --
    public function storeFile(UploadedFile $file, string $directory, string $filename) {
        return $file->storeAs($directory, $filename, 'public');
    }

    public function ensureSongCanBeStored(array $data) {
        $existing = Song::where('artist_id', $data['artist_id'])->where('title', $data['title'])->exists();

        if ($existing)
            throw new BusinessException("There's already a song with the same name under that artist.");

        if (!isset($data['audio_file']) && !$data['audio_file'])
            throw new BusinessException("You must provide an audio file.");
    }

    public function storeSong(User $auth_user, array $data) {
        $this->ensureSongCanBeStored($data);

        $is_single = !isset($data['album_id']) || is_null($data['album_id']);

        if ($is_single)
            $song_container = Artist::find($data['artist_id']);
        else
            $song_container = Album::find($data['album_id']);

        $new_song = $song_container->songs()->create([
            "uploader_id" => $auth_user->id,
            "artist_id" => $data['artist_id'],
            "album_id" => $is_single ? null : $data['album_id'],
            "title" => $data["title"],
        ]);

        //STORING THE FILE
        $directory = $is_single ? 
            "artists/{$data['artist_id']}/songs/singles" : 
            "artists/{$data['artist_id']}/songs/{$data['album_id']}";

        $filename = "{$new_song->id}.mp3";

        $file_route = $this->storeFile($data['audio_file'], $directory, $filename);
        $new_song->update(["file_route" => $file_route]);

        return $new_song;
    }

    //-- UPDATE -- 
    public function ensureSongCanBeUpdated(User $auth_user, Song $song, array $data) {
        if ($song->uploader->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to update this resource.");

        $existing = Song::where('id', '!=', $song->id)
        ->where('artist_id', $song->artist_id)
        ->where('title', $data['title'])->exists();

        if ($existing)
            throw new BusinessException("There's already a song with the same name under that artist.");
    }

public function updateSong(User $auth_user, Song $song, array $data) {
        $this->ensureSongCanBeUpdated($auth_user, $song, $data);
        $song->fill($data);

        if ($song->isDirty('album_id')) {
            $old_is_single = is_null($song->getOriginal('album_id'));
            $old_album_id  = $song->getOriginal('album_id');
            
            $old_directory = $old_is_single ? 
                "artists/{$song->artist_id}/songs/singles" : 
                "artists/{$song->artist_id}/songs/{$old_album_id}";

            $new_is_single = is_null($song->album_id);
            $new_directory = $new_is_single ? 
                "artists/{$song->artist_id}/songs/singles" : 
                "artists/{$song->artist_id}/songs/{$song->album_id}";

            $filename = "{$song->id}.mp3";

            $old_file_path = $old_directory.'/'.$filename;
            $new_file_path = $new_directory.'/'.$filename;

            if (Storage::disk('public')->exists($old_file_path)) {
                Storage::disk('public')->makeDirectory($new_directory);
                Storage::disk('public')->move($old_file_path, $new_file_path);
            }

            $song->file_route = $new_file_path;
        }

        //UPDATE AUDIO FILE
        if (isset($data['audio_file']) && $data['audio_file']) {
            $final_directory = is_null($song->album_id) ? 
                "artists/{$song->artist_id}/songs/singles" : 
                "artists/{$song->artist_id}/songs/{$song->album_id}";

            $filename = "{$song->id}.mp3";
            
            $song->file_route = $this->storeFile($data['audio_file'], $final_directory, $filename);
        }

        $song->save();
        $song->refresh();

        return $song;
    }

    //-- DELETE --
    public function ensureSongCanBeDeleted(User $auth_user, Song $song) {
        if ($song->uploader->isNot($auth_user) && (!$auth_user->isAdmin()))
            throw new BusinessException("You are not allowed to delete this resource.");
    }

    public function removeSong(User $auth_user, Song $song) {
        $this->ensureSongCanBeDeleted($auth_user, $song);
        
        $directory = is_null($song->album_id) ? 
            "artists/{$song->artist->id}/songs/singles" : 
            "artists/{$song->artist->id}/songs/{$song->album->id}";

        Storage::disk('public')->delete($directory."/{$song->id}.mp3");

        return $song->delete();
    }
}