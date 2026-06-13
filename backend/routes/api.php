<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PlaylistReactionController;
use App\Http\Controllers\PlaylistSongController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserFollowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    //-- PROFILES --
    Route::controller(ProfileController::class)->group(function () {
        Route::get   ('/me', 'me');
        Route::get   ('/users', 'index');
        Route::get   ('/users/{user}', 'show');
        Route::patch ('/users/{user}', 'update');
    });

    //-- USER FOLLOWS --
    Route::controller(UserFollowController::class)->group(function () {
        Route::get   ('/follows/followers', 'followers');
        Route::get   ('/follows/following', 'following');
        Route::post  ('/follows/{user}', 'store');
        Route::delete('/follows/{user}', 'destroy');
    });

    //-- ARTISTS --
    Route::controller(ArtistController::class)->group(function () {
        Route::get   ('/artists', 'index');
        Route::post  ('/artists', 'store');
        Route::get   ('/artists/{artist}', 'show');
        Route::patch ('/artists/{artist}', 'update');
        Route::delete('/artists/{artist}', 'destroy');

    });

    //-- ALBUMS --
    Route::controller(AlbumController::class)->group(function () {
        Route::get   ('/artists/{artist}/albums', 'index');
        Route::post  ('/artists/{artist}/albums', 'store');
        Route::get   ('/albums/{album}', 'show');
        Route::patch ('/albums/{album}', 'update');
        Route::delete('/albums/{album}', 'destroy');
    });

    //-- SONGS --
    Route::controller(SongController::class)->group(function () {
        Route::get   ('/songs', 'index');
        Route::post  ('/songs', 'store');
        Route::get   ('/songs/{song}', 'show');
        Route::patch ('/songs/{song}', 'update');
        Route::delete('/songs/{song}', 'destroy');
    });

    //-- PLAYLISTS --
    Route::controller(PlaylistController::class)->group(function () {
        Route::get   ('/myPlaylists', 'myPlaylists');
        Route::get   ('/playlists', 'index');
        Route::post  ('/playlists', 'store');
        Route::get   ('/playlists/{playlist}', 'show');
        Route::patch ('/playlists/{playlist}', 'update');
        Route::delete('/playlists/{playlist}', 'destroy');
    });

    //-- PLAYLIST SONGS --
    Route::controller(PlaylistSongController::class)->group(function () {
        Route::get   ('/playlists/{playlist}/songs', 'playlistSongs');
        Route::post  ('/playlists/{playlist}/songs/{song}', 'store');
        Route::delete('/playlists/{playlist}/songs/{song}', 'destroy');
    });

    //-- PLAYLIST REACTIONS --
    Route::controller(PlaylistReactionController::class)->group(function () {
        Route::get   ('/playlists/{playlist}/reactions', 'playlistReactions');
        Route::put   ('/playlists/{playlist}/reactions', 'react');
    });

    //-- REPORTS --
    Route::controller(ReportController::class)->group(function () {
        Route::get   ('/myReports', 'myReports');
        Route::get   ('/reports', 'index');
        Route::post  ('/reports', 'store');
        Route::get   ('/reports/{report}', 'show');
        Route::delete('/reports/{report}', 'destroy');
    });
});

Route::get('/test-session', function (Request $request) {
    return [
        'session_id' => $request->session()->getId(),
        'user' => $request->user(),
    ];
});

require __DIR__.'/auth.php';