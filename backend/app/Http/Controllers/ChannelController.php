<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use App\Models\User;
use App\Services\ChannelService;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller {
    public function upsert(ChannelRequest $request, ChannelService $channel_service) {
        $data = $request->validated();
        $upserted_channel = $channel_service->storeChannel(Auth::user(), $data);

        return (new ChannelResource($upserted_channel))->response()->setStatusCode(200);
    }

    public function show(User $user, ChannelService $channel_service) {
        $channel_service->ensureChannelCanBeAccessed($user, Auth::user());
        $channel = Channel::where('host_id', $user->id)->with(['host', 'currentPlaylist', 'currentSong'])->firstOrFail();

        return new ChannelResource($channel);
    }
}