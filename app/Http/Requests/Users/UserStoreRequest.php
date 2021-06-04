<?php

namespace App\Http\Requests\Users;

use App\Models\Users\User;
use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        return [
            'profile_picture' => app(User::class)->getMediaValidationRules('profile_pictures'),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof', Rule::unique(User::class)],
            'password' => ['nullable', Password::defaults()],
        ];
    }
}
