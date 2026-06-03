<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistReactionRequest;
use App\Models\Playlist;
use App\Services\PlaylistReactionService;
use Illuminate\Support\Facades\Auth;

class PlaylistReactionController extends Controller {
    public function playlistReactions(Playlist $playlist) {
        $all_reactions = $playlist->reactions;

        //ANONYMOUS
        $likes_count = $all_reactions->filter(function ($user) {return $user->pivot->like_status === Playlist::REACTION_LIKE; })->count();
        $dislikes_count = $all_reactions->filter(function ($user) {return $user->pivot->like_status === Playlist::REACTION_DISLIKE;})->count();
        $times_saved_count = $all_reactions->filter(function ($user) {return (bool) $user->pivot->saved_by_user === true;})->count();

        $currentUserReaction = $all_reactions->firstWhere('id', Auth::id());

        return response()->json([
            'playlist_id' => $playlist->id,
            'statistics' => [
                'likes_count'       => $likes_count,
                'dislikes_count'    => $dislikes_count,
                'times_saved_count' => $times_saved_count,
            ],
            'user_context' => [
                'like_status'   => $currentUserReaction ? $currentUserReaction->pivot->like_status : Playlist::REACTION_NONE,
                'saved_by_user' => $currentUserReaction ? (bool) $currentUserReaction->pivot->saved_by_user : false,
            ]
        ]);
    }

    public function react(Playlist $playlist, PlaylistReactionRequest $request, PlaylistReactionService $playlist_reaction_service) {
        $data = $request->validated();
        $status = $playlist_reaction_service->storePlaylistReaction(Auth::user(), $playlist, $data);
        
        $message = $status === 'deleted' ? 'Reaction cleared successfully.' : 'Reaction saved successfully.';

        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}