<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends \Spatie\WelcomeNotification\WelcomeController
{
    use PasswordValidationRules;

    public function showWelcomeForm(Request $request, User $user): View
    {
        SEOTools::setTitle(__('Welcome'));

        return parent::showWelcomeForm($request, $user);
    }

    public function savePassword(Request $request, User $user): Response
    {
        $response = parent::savePassword($request, $user);
        if (! $request->user()->hasVerifiedEmail() && $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
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
        return ['password' => array_merge(['required'], $this->passwordRules())];
    }
}
