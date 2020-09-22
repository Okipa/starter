<?php

namespace App\Http\Requests\Users;

use App\Models\Users\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profile_picture' => User::getMediaValidationRules('profile_pictures'),
            'remove_avatar' => ['required', 'boolean'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email:rfc,dns,spoof',
                'max:255',
                'unique:users,email,' . $this->user->id,
            ],
            'new_password' => ['nullable', 'string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['remove_avatar' => (bool) $this->remove_avatar]);
    }
}
