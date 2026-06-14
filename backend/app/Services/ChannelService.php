<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\Channel;
use App\Models\Playlist;
use App\Models\User;

class ChannelService {
    public function ensureChannelCanBeAccessed(User $host, User $current_user){
        if (!$host->followers()->where('id', $current_user->id)->exists())
            throw new BusinessException("You cannot access a channel of a user you don't follow.");
    }

    public function ensureChannelCanBeStored(array $data): void {
        if (!empty($data['current_song_id'])) {
            $playlist = Playlist::find($data['playlist_id']);
            
            if (!$playlist->songs()->where('songs.id', $data['current_song_id'])->exists())
                throw new BusinessException("The requested song does not belong to the selected playlist.");
        }
    }

    public function storeChannel(User $current_user, array $data): Channel {
        $this->ensureChannelCanBeStored($data);
        $channel = $current_user->hostedChannel;

        $incoming_timestamp = $data['sync_timestamp'] ?? 0.000;
        $incoming_song_id   = $data['current_song_id'] ?? null;
        $sync_assigned_at = now();
        
        if ($channel) {
            $track_changed = $channel->current_song_id != $incoming_song_id;
            $scrubbed      = (float)$channel->sync_timestamp != (float)$incoming_timestamp;

            if (!$track_changed && !$scrubbed)
                $sync_assigned_at = $channel->sync_assigned_at;
        }

        return $current_user->hostedChannel()->updateOrCreate(
            ['host_id' => $current_user->id],
            [
                'playlist_id'      => $data['playlist_id'],
                'current_song_id'  => $incoming_song_id,
                'is_paused'        => $data['is_paused'] ?? false,
                'sync_timestamp'   => $incoming_timestamp,
                'sync_assigned_at' => $sync_assigned_at,
            ]
        );
    }
}