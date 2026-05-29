<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class UserFollowResource extends JsonResource{ 
    public function toArray(Request $request): array { 
        return [
            "follower_user_id" => $this->follower_user_id,
            "followed_user_id" => $this->followed_user_id,
        ];
    } 
}