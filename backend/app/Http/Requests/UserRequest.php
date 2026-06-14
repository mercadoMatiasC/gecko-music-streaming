<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $user_id = $this->user()->id;

        return [
            'username' => ['sometimes', 'string', 'max:30', "unique:users,username,{$user_id}"],
            'email'    => ['sometimes', 'email', "unique:users,email,{$user_id}"],
            'password' => ['sometimes', 'confirmed', 'min:8'],
            'active_status' => ['sometimes', 'boolean'],
            'is_admin' => ['sometimes', 'boolean']
        ];
    }
}
