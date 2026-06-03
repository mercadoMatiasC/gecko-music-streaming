<?php
namespace App\Services;

use App\Models\Playlist;
use App\Models\User;

class PlaylistReactionService {
    public function ensureReactionCanBeStored(User $auth_user, Playlist $playlist) {
        return true;
    }

    public function storePlaylistReaction(User $auth_user, Playlist $playlist, array $data) {
        $this->ensureReactionCanBeStored($auth_user, $playlist);

        $like_status = (int) $data['like_status'];
        $saved_by_user = (bool) $data['saved_by_user'];

        if ($like_status === Playlist::REACTION_NONE && !$saved_by_user) {
            $playlist->reactions()->detach($auth_user->id);
            
            return 'deleted';
        } else {
            $playlist->reactions()->syncWithPivotValues([$auth_user->id], [
                'like_status'   => $like_status,
                'saved_by_user' => $saved_by_user,
            ], false);
            
            return 'upserted';
        }
    }
}