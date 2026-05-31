<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class SongRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'artist_id'  => ['required', 'integer', 'exists:artists,id'],
            'album_id'   => ['nullable', 'integer', 'exists:albums,id'],
            'title'      => ['required', 'string', 'max:30'],
            'play_count' => ['nullable', 'integer', 'min:0'],
            'audio_file' => ['sometimes', File::types(['mp3', 'wav', 'aac', 'ogg'])->max(1024 * 10)]
        ];
    }
}