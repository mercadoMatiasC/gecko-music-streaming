<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Resources\AlbumIndexResource;
use App\Http\Resources\AlbumShowResource;
use App\Models\Album;
use App\Models\Artist;
use App\Services\AlbumService;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller {
    public function index(Artist $artist) {
        $albums = $artist->albums()->paginate(8);
        return AlbumIndexResource::collection($albums);
    }

    public function store(AlbumRequest $request, Artist $artist, AlbumService $album_service) {
        $data = $request->validated();
        $album = $album_service->storeAlbum(Auth::user(), $artist, $data);

        return (new AlbumShowResource($album))->response()->setStatusCode(201);
    }

    public function show(Album $album) {
        $album->load(['uploader', 'artist']);

        return new AlbumShowResource($album);
    }

    public function update(AlbumRequest $request, Album $album, AlbumService $album_service) {
        $data = $request->validated();
        $album = $album_service->updateAlbum(Auth::user(), $album, $data);

        return (new AlbumShowResource($album))->response()->setStatusCode(200);
    }

    public function destroy(Album $album, AlbumService $album_service) {
        $album = $album_service->removeAlbum(Auth::user(), $album);

        return response()->json(
            [
                'success' => true,
                'message' => 'Album removed successfully'
            ], 200);
    }
}
