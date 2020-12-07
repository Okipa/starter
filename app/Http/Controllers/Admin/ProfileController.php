<?php

namespace App\Http\Controllers\Admin;

use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View;

class ProfileController
{
    public function show(): View
    {
        $user = auth()->user();
        SEOTools::setTitle(__('Profile'));

        return view('templates.admin.users.profile', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function deleteAccount(Request $request): RedirectResponse
    {
        if (! Hash::check($request->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ])->errorBag('deleteAccount');
        }
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect(RouteServiceProvider::HOME)->with('success', __('Your account has been deleted.'));
    }
}
