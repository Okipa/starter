<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        showLoginForm as traitShowLoginForm;
    }

    public function showLoginForm(): View
    {
        SEOTools::setTitle(__('Sign in area'));

        return $this->traitShowLoginForm();
    }

    protected function redirectPath(): string
    {
        return route('admin.index');
    }

    protected function loggedOut(): RedirectResponse
    {
        alert()->toast(__('You have been logged out.'), 'success');

        return redirect()->route('home.page.show');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function authenticated(Request $request, User $user): void
    {
        alert()->toast(__('Welcome') . ' ' . $user->name . '.', 'success');
    }
}
