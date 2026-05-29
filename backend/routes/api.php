<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserFollowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::middleware(['auth:sanctum'])->group(function () {
        //-- PROFILE --
        Route::controller(ProfileController::class)->group(function () {
            Route::get   ('/me', 'me');
            Route::get   ('/users', 'index');
            Route::get   ('/users/{user}', 'show');
            Route::patch ('/users/{user}', 'update');
        });

        Route::controller(UserFollowController::class)->group(function () {
            Route::get   ('/follows/followers', 'followers');
            Route::get   ('/follows/following', 'following');
            Route::post  ('/follows/{user}', 'store');
            Route::delete('/follows/{user}', 'destroy');
        });
    });

    Route::get('/test-session', function (Request $request) {
        return [
            'session_id' => $request->session()->getId(),
            'user' => $request->user(),
        ];
    });


require __DIR__.'/auth.php';