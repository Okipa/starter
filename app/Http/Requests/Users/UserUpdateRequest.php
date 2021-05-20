<?php

namespace App\Http\Requests\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Users\User;
use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        return [
            'profile_picture' => app(User::class)->getMediaValidationRules('profile_pictures'),
            'remove_profile_picture' => ['required', 'boolean'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'email' => [
                'required',
                'string',
                'email:rfc,dns,spoof',
                'max:255',
                Rule::unique(User::class)->ignore($this->user),
            ],
            'new_password' => array_merge(['nullable'], $this->passwordRules()),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['remove_profile_picture' => (bool) $this->remove_profile_picture]);
    }
}
