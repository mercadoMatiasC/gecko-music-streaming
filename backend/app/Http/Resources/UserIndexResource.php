<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class UserIndexResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "id" => $this->id,
            "username" => $this->username,
            "profile_image_route" => $this->profile_image_route ? asset('storage/' . $this->profile_image_route) : null,
        ];
    } 
}