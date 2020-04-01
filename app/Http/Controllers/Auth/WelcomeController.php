<?php

namespace App\Http\Controllers\Auth;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends \Spatie\WelcomeNotification\WelcomeController
{
    public function showWelcomeForm(Request $request, User $user): View
    {
        SEOTools::setTitle(__('Welcome'));

        return parent::showWelcomeForm($request, $user);
    }

    public function savePassword(Request $request, User $user): Response
    {
        $response = parent::savePassword($request, $user);
        if (! $request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
        }

        return $response;
    }

    public function sendPasswordSavedResponse(): Response
    {
        alert()->html(__('Success'), __('Your new password has been saved.'), 'success');

        return redirect()->route('admin.index');
    }

    protected function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
