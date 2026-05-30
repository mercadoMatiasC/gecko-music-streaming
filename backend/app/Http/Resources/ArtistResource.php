<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class ArtistResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            "id" => $this->id,
            "uploader" => $this->uploader_id,
            "name" => $this->name,
            "artist_image_route" => $this->artist_image_route ? asset('storage/' . $this->artist_image_route) : null,
        ];
    }
}