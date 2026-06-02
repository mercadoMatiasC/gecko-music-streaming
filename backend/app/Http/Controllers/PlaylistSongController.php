<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongIndexResource;
use App\Models\Playlist;
use App\Models\Song;
use App\Services\PlaylistSongService;
use Illuminate\Support\Facades\Auth;

class PlaylistSongController extends Controller {
    public function playlistSongs(Playlist $playlist) {
        $songs = $playlist->songs()->with(['artist', 'album'])->paginate(20);

        //LATER ON SORTING OPTIONS WILL BE IMPLEMENTED HERE

        return SongIndexResource::collection($songs);
    }

    public function store(Playlist $playlist, Song $song, PlaylistSongService $playlist_song_service) {
        $playlist_song_service->storePlaylistSong(Auth::user(), $playlist, $song);
        
        return (new SongIndexResource($song))->response()->setStatusCode(201);
    }

    public function destroy(Playlist $playlist, Song $song, PlaylistSongService $playlist_song_service) {
        $playlist_song_service->removePlaylistSong(Auth::user(), $playlist, $song);

        return response()->json(
            [
                'success' => true,
                'message' => 'Song removed successfully from playlist'
            ], 200);
    }
}