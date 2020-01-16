<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Users\UsersService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers {
        showRegistrationForm as traitShowRegistrationForm;
    }

    /** @inheritDoc */
    public function showRegistrationForm()
    {
        SEOTools::setTitle(__('Registration area'));

        return $this->traitShowRegistrationForm();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\User
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function create(array $data)
    {
        /** @var User $user */
        $user = (new User)->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        (new UsersService)->setDefaultAvatar($user);

        return $user;
    }

    /** @inheritDoc */
    protected function registered(Request $request)
    {
        alert()->toast(
            __('Welcome to your new account') . ', ' . $request->first_name . ' ' . $request->last_name . '.',
            'success'
        );

        return;
    }

    /** @inheritDoc */
    protected function redirectPath()
    {
        return route('admin.index');
    }
}
