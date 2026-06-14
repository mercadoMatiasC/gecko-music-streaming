<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'playlist_id'     => ['required', 'integer', 'in:playlists,id'],
            'current_song_id' => ['sometimes', 'nullable', 'integer', 'in:songs,id'],
            'is_paused'       => ['sometimes', 'boolean'],
            'sync_timestamp'  => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}