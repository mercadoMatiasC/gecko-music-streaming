<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'title'                => ['required', 'string', 'max:30'],
            'playlist_image_route' => ['nullable', 'string', 'max:255'],
        ];
    }
}