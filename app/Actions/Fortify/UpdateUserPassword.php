<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    /**
     * Validate and update the user's password.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', Password::defaults()],
        ])->after(function ($validator) use ($user, $input) {
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()
                    ->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');
        $user->forceFill(['password' => Hash::make($input['new_password'])])->save();
        toast()->success(__('Your new password has been saved.'));
    }
}
