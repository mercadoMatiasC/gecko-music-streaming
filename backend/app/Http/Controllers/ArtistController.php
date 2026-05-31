<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use App\Services\ArtistService;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller {
    public function index() {
        $artists = Artist::paginate(8);
        return ArtistResource::collection($artists);
    }

    public function store(ArtistRequest $request, ArtistService $artist_service) {
        $data = $request->validated();
        $artist = $artist_service->storeArtist(Auth::user(), $data);

        return (new ArtistResource($artist))->response()->setStatusCode(201);
    }

    public function show(Artist $artist) {
        return new ArtistResource($artist);
    }

    public function update(ArtistRequest $request, Artist $artist, ArtistService $artist_service) {
        $data = $request->validated();
        $artist = $artist_service->updateArtist(Auth::user(), $artist, $data);

        return (new ArtistResource($artist))->response()->setStatusCode(200);
    }

    public function destroy(Artist $artist, ArtistService $artist_service) {
        $artist_service->removeArtist(Auth::user(), $artist);

        return response()->json(
            [
                'success' => true,
                'message' => 'Artist removed successfully'
            ], 200);
    }
}
