<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'title'             => ['required', 'string', 'max:30'],
            'album_image_route' => ['nullable', 'string', 'max:255'],
            'date_released'     => ['required', 'date', 'date_format:Y-m-d', 'before:today'],
        ];
    }
}