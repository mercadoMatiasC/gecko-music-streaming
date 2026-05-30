<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArtistRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:30', Rule::unique('artists', 'name')->ignore($this->route('artist')->id)],
            'artist_image_route' => ['nullable', 'string', 'max:255'],
        ];
    }
}
