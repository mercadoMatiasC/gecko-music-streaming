<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Http\Resources\PlaylistIndexResource;
use App\Http\Resources\PlaylistShowResource;
use App\Models\Playlist;
use App\Services\PlaylistService;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller {
    public function myPlaylists() {
        $playlists = Auth::user()->playlists()->orderBy('created_at', 'desc')->paginate(8);

        return PlaylistIndexResource::collection($playlists);
    }

    public function index() {
        $playlists = Playlist::orderBy('created_at', 'desc')->paginate(8);

        return PlaylistIndexResource::collection($playlists);
    }

    public function store(PlaylistRequest $request, PlaylistService $playlist_service) {
        $data = $request->validated();
        $playlist = $playlist_service->storePlaylist(Auth::user(), $data);

        return (new PlaylistShowResource($playlist))->response()->setStatusCode(201);
    }

    public function show(Playlist $playlist) {
        $playlist->load(['owner']);

        return new PlaylistShowResource($playlist);
    }

    public function update(PlaylistRequest $request, Playlist $playlist, PlaylistService $playlist_service) {
        $data = $request->validated();
        $playlist = $playlist_service->updatePlaylist(Auth::user(), $playlist, $data);

        return (new PlaylistShowResource($playlist))->response()->setStatusCode(200);
    }

    public function destroy(Playlist $playlist, PlaylistService $playlist_service) {
        $playlist_service->removePlaylist(Auth::user(), $playlist);

        return response()->json(
            [
                'success' => true,
                'message' => 'Playlist removed successfully'
            ], 200);
    }
}
