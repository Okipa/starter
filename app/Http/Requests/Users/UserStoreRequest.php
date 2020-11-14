<?php

namespace App\Http\Requests\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Users\User;
use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    use PasswordValidationRules;

    public function rules(): array
    {
        return [
            'profile_picture' => app(User::class)->getMediaValidationRules('profile_pictures'),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ];
    }
}
