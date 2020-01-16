<?php

namespace App\Http\Controllers\Auth;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Spatie\WelcomeNotification\WelcomeController;
use Symfony\Component\HttpFoundation\Response;

class InitializePasswordController extends WelcomeController
{
    /** @inheritDoc */
    public function showWelcomeForm(Request $request, User $user)
    {
        SEOTools::setTitle(__('Welcome'));

        return parent::showWelcomeForm($request, $user);
    }

    /** @inheritDoc */
    public function savePassword(Request $request, User $user)
    {
        $response = parent::savePassword($request, $user);
        if (! $request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
        }

        return $response;
    }

    /** @inheritDoc */
    public function sendPasswordSavedResponse(): Response
    {
        alert()->html(__('Success'), __('Your new password has been saved.'), 'success');

        return redirect()->route('admin.index');
    }

    /** @inheritDoc */
    protected function rules()
    {
        return [
            'password' => ['required', 'string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
