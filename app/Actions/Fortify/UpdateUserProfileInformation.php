<?php

namespace App\Actions\Fortify;

use App\Models\Users\User;
use App\Rules\PhoneInternational;
use App\Services\Users\UsersService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update($user, array $input): void
    {
        $input = array_merge($input, ['remove_profile_picture' => (bool) data_get($input, 'remove_profile_picture')]);
        Validator::make($input, [
            'profile_picture' => array_merge(['nullable'], (new User)->getMediaValidationRules('profile_pictures')),
            'remove_profile_picture' => ['required', 'boolean'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational],
            'email' => [
                'required',
                'string',
                'max:255',
                'email:rfc,dns,spoof',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');
        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'phone_number' => $input['phone_number'],
                'email' => $input['email'],
            ])->save();
            toast()->success(__('Your profile information have been saved.'));
        }
        if(data_get($input, 'profile_picture') || $input['remove_profile_picture']) {
            $uploadedFiled = $input['remove_profile_picture'] ? null : data_get($input, 'profile_picture');
            (new UsersService)->saveAvatarFromUploadedFile($uploadedFiled, $user);
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     */
    protected function updateVerifiedUser($user, array $input): void
    {
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        $user->sendEmailVerificationNotification();
    }
}
