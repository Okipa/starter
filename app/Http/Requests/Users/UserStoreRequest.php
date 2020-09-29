<?php

namespace App\Http\Requests\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Users\User;
use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    use PasswordValidationRules;

    public function rules(): array
    {
        return [
            'profile_picture' => (new User)->getMediaValidationRules('profile_pictures'),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof', 'unique:users'],
            'password' => $this->passwordRules(),
        ];
    }
}
