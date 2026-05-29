<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserIndexResource;
use App\Http\Resources\UserShowResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public function index() {
        $users = User::paginate(8);
        return UserIndexResource::collection($users);
    }

    public function me() {
        $user = Auth::user();
        return (new UserShowResource($user));
    }

    public function show(User $user) {
        return (new UserShowResource($user));
    }

    public function update(UserRequest $request, UserService $use_service, User $user) {
        $data = $request->validated();
        $user = $use_service->updateProfile(Arr::except($data, ['logo_file']), $user);

        return (new UserShowResource($user))->response()->setStatusCode(200);
    }

    public function destroy(string $id) {
        //
    }
}
