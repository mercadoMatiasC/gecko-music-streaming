<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class SongIndexResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            'artist'   => ArtistResource::make($this->whenLoaded('artist')),
            'album'   => AlbumIndexResource::make($this->whenLoaded('album')),
            "title" => $this->title,
        ];
    } 
}