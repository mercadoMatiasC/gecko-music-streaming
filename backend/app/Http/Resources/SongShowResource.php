<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class SongShowResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            'uploader' => UserIndexResource::make($this->whenLoaded('uploader')),
            'artist'   => ArtistResource::make($this->whenLoaded('artist')),
            'album'   => AlbumIndexResource::make($this->whenLoaded('album')),
            "title" => $this->title,
            "play_count" => $this->play_count,
            "file_route" => asset('storage/'.$this->file_route),
        ];
    } 
}