<?php

namespace App\Http\Requests\Users;

use App\Models\Users\User;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profile_picture' => User::getMediaValidationRules('profile_pictures'),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof', 'unique:users'],
            'password' => ['nullable', 'string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
