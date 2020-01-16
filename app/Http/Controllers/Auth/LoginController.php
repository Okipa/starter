<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers {
        showLoginForm as traitShowLoginForm;
        sendLockoutResponse as traitSendLockoutResponse;
    }

    /** @inheritDoc */
    public function showLoginForm()
    {
        SEOTools::setTitle(__('Sign in area'));

        return $this->traitShowLoginForm();
    }

    /** @inheritDoc */
    protected function redirectPath()
    {
        return route('admin.index');
    }

    /** @inheritDoc */
    protected function loggedOut()
    {
        alert()->toast(__('You have been logged out.'), 'success');

        return redirect()->route('home');
    }

    /** @inheritDoc */
    protected function authenticated(Request $request, $user)
    {
        alert()->toast(__('Welcome') . ' ' . $user->name . '.', 'success');

        return;
    }
}
