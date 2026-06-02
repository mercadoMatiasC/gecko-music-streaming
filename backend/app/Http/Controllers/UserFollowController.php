<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFollowResource;
use App\Http\Resources\UserIndexResource;
use App\Models\User;
use App\Services\UserFollowService;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends Controller {
    public function followers() {
        $followers = Auth::user()->followers()->get();
        return UserIndexResource::collection($followers);
    }

    public function following() {
        $following = Auth::user()->following()->get();
        return UserIndexResource::collection($following);
    }

    public function store(User $user, UserFollowService $user_follow_service) {
        $user_follow = $user_follow_service->storeFollow(Auth::user(), $user);
        
        //NO CHANNELS FOR NOW
        /*  
            $senderData = [
                'username' => $me->username,
                'profile_image_route' => $me->profile_image_route ? asset('storage/' . $me->profile_image_route) : null
            ];

            broadcast(new PrivateFollowReceived($user->id, $senderData))->toOthers(); 
        */ 

        return (new UserIndexResource($user))->response()->setStatusCode(201);
    }

    public function destroy(User $user, UserFollowService $user_follow_service) {
        $user_follow_service->removeFollow(Auth::user(), $user);

        return response()->json(
            [
                'success' => true,
                'message' => 'Follow removed successfully'
            ], 200);
    }
}