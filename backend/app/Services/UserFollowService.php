<?php
namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\User;

class UserFollowService {

    public function ensureUserCanFollow(User $auth_user, User $requested_user) {
        if ($requested_user->is($auth_user))
            throw new BusinessException("You cannot send a follow to yourself.");

        if (!$requested_user->active_status)
            throw new BusinessException("The requested user is not available.");

        $existing = $auth_user->following()->where('followed_user_id', $requested_user->id)->exists();

        if ($existing)
            throw new BusinessException("You are already following ".$requested_user->username.".");
    }

    public function storeFollow(User $auth_user, User $requested_user) {
        $this->ensureUserCanFollow($auth_user, $requested_user);
        $auth_user->following()->attach($requested_user->id);
        
        return true;
    }

    public function removeFollow(User $auth_user, User $other_user) {
        $exists = $auth_user->following()->where('followed_user_id', $other_user->id)->exists();

        if (!$exists)
            throw new BusinessException("You are not following ".$other_user->username.".");

        $auth_user->following()->detach($other_user->id);

        return true;
    }
}