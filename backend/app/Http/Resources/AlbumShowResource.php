<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class AlbumShowResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            'uploader' => UserIndexResource::make($this->whenLoaded('uploader')),
            'artist'   => ArtistResource::make($this->whenLoaded('artist')),
            "title" => $this->title,
            "album_image_route" => $this->album_image_route ? asset('storage/' . $this->album_image_route) : null,
            "date_released" => $this->date_released,
        ];
    } 
}