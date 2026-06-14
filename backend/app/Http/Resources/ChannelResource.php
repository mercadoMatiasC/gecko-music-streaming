<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class ChannelResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            'host'     => UserIndexResource::make($this->whenLoaded('host')),
            'playlist' => PlaylistIndexResource::make($this->whenLoaded('currentPlaylist')),
            'song'     => SongShowResource::make($this->whenLoaded('currentSong')),
            "is_paused" => $this->is_paused,
            "sync_timestamp" => $this->sync_timestamp,
            "sync_assigned_at" => $this->sync_assigned_at ? $this->sync_assigned_at->toIso8601String() : null,
        ];
    } 
}