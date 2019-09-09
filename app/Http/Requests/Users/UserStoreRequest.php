<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use App\Models\User;

class UserStoreRequest extends Request
{
    protected $exceptFromSanitize = ['password'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Spatie\MediaLibrary\Exceptions\CollectionNotFound
     * @throws \Spatie\MediaLibrary\Exceptions\ConversionsNotFound
     */
    public function rules()
    {
        return [
            'avatar'     => [(new User)->validationConstraints('avatar')],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
