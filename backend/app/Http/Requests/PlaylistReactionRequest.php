<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use Illuminate\Foundation\Http\FormRequest;

class PlaylistReactionRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'like_status' => ['required', 'integer', 'in:'.implode(',', Playlist::REACTION_STATUSES)],
            'saved_by_user' => ['required', 'boolean'],
        ];
    }
}