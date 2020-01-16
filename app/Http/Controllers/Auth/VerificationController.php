<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

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

    /** @inheritDoc */
    public function show(Request $request)
    {
        SEOTools::setTitle(__('Email address verification'));

        return $this->traitShow($request);
    }

    /** @inheritDoc */
    public function redirectPath()
    {
        return route('admin.index');
    }

    /** @inheritDoc */
    public function resend(Request $request)
    {
        $response = $this->traitResend($request);
        if (! $request->user()->hasVerifiedEmail()) {
            alert()->html(__('Success'), __('We have e-mailed your new verification link.'), 'success')
                ->showConfirmButton();
        }

        return $response;
    }

    /** @inheritDoc */
    public function verify(Request $request)
    {
        $response = $this->traitVerify($request);
        alert()->html(__('Success'), __('Your e-mail address has been confirmed.'), 'success')->showConfirmButton();

        return $response;
    }
}
