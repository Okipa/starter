<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails {
        show as traitShow;
        resend as traitResend;
        verify as traitVerify;
    }

    public function show(Request $request): Response
    {
        SEOTools::setTitle(__('Email address verification'));

        return $this->traitShow($request);
    }

    public function redirectPath(): string
    {
        return route('admin.index');
    }

    public function resend(Request $request): Response
    {
        $response = $this->traitResend($request);
        if (! $request->user()->hasVerifiedEmail()) {
            alert()->html(__('Success'), __('We have e-mailed your new verification link.'), 'success')
                ->showConfirmButton();
        }

        return $response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request): Response
    {
        $response = $this->traitVerify($request);
        alert()->html(__('Success'), __('Your e-mail address has been confirmed.'), 'success')->showConfirmButton();

        return $response;
    }
}
