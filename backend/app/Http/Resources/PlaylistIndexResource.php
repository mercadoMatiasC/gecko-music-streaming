<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class PlaylistIndexResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            "title" => $this->title,
            "playlist_image_route" => $this->playlist_image_route ? asset('storage/'.$this->playlist_image_route) : null,
        ];
    } 
}