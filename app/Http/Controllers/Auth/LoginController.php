<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
        sendLockoutResponse as protected traitSendLockoutResponse;
    }

    /**
     * Show the application's login form.
     *
     * @return Factory|View
     */
    public function showLoginForm()
    {
        SEOTools::setTitle(__('Sign in area'));

        return view('templates.auth.login');
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return route('admin');
    }

    /**
     * The user has logged out of the application.
     *
     * @return mixed
     */
    protected function loggedOut()
    {
        alert()->toast(__('You have been logged out.'), 'success');

        return;
    }

    /**
     * Get the failed login response instance.
     *
     * @return void
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [__('The provided credentials do not match our records.')]
        ])->redirectTo(route('login'));
    }

    /**
     * The user has been authenticated.
     *
     * @return mixed
     */
    protected function authenticated()
    {
        alert()->toast(__('Welcome :name.', [
            'name' => auth()->user()->name,
        ]), 'success');

        return;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param Request $request
     *
     * @return void
     * @throws ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn($this->throttleKey($request));
        throw ValidationException::withMessages([$this->username() => [
            __('Too many connection attempts detected. Please try again in :seconds seconds.', ['seconds' => $seconds])
        ]])->status(429);
    }
}
