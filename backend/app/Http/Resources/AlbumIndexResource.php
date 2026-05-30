<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class AlbumIndexResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            'artist_id' => $this->artist_id,
            "title" => $this->title,
            "album_image_route" => $this->album_image_route ? asset('storage/' . $this->album_image_route) : null,
            "date_released" => $this->date_released,
        ];
    } 
}