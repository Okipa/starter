<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use App\Models\Users\User;

class UserUpdateRequest extends Request
{
    protected $exceptFromSanitize = ['new_password'];

    protected $safetyChecks = ['remove_avatar' => 'boolean'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => (new User)->validationConstraints('avatar'),
            'remove_avatar' => ['required', 'boolean'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $this->user->id,
            ],
            'new_password' => ['string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
