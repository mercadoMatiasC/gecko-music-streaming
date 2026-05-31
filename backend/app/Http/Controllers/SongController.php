<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongRequest;
use App\Http\Resources\SongIndexResource;
use App\Http\Resources\SongShowResource;
use App\Models\Song;
use App\Services\SongService;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller {
    public function index() {
        $songs = Song::with(['artist', 'album'])->orderBy('play_count', 'desc')->paginate(8);

        return SongIndexResource::collection($songs);
    }

    public function store(SongRequest $request, SongService $song_service) {
        $data = $request->validated();
        $song = $song_service->storeSong(Auth::user(), $data);

        return (new SongShowResource($song))->response()->setStatusCode(201);
    }

    public function show(Song $song) {
        $song->load(['uploader', 'artist', 'album']);

        return new SongShowResource($song);
    }

    public function update(SongRequest $request, Song $song, SongService $song_service) {
        $data = $request->validated();
        $song = $song_service->updateSong(Auth::user(), $song, $data);

        return (new SongShowResource($song))->response()->setStatusCode(200);
    }

    public function destroy(Song $song, SongService $song_service) {
        $song_service->removeSong(Auth::user(), $song);

        return response()->json(
            [
                'success' => true,
                'message' => 'Song removed successfully'
            ], 200);
    }
}