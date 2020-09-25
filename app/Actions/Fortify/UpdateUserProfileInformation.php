<?php

namespace App\Actions\Fortify;

use App\Models\Users\User;
use App\Services\Users\UsersService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
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
     */
    public function update($user, array $input): void
    {
        // todo: finish this
        Validator::make($input, [
            'profile_picture' => (new User)->getMediaValidationRules('profile_pictures'),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'max:255',
                'email:rfc,dns,spoof',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');
        (new UsersService)->saveAvatarFromRequest($request, $user);
        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
            ])->save();
            alert()->html(__('Success'), __('Your profile information have been saved.'), 'success');
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
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        $user->sendEmailVerificationNotification();
    }
}
