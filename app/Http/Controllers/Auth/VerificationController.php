<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

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
        resend as traitResend;
        verify as traitVerify;
    }

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Show the email verification notice.
     *
     * @param Request $request
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Request $request)
    {
        SEOTools::setTitle(__('Email address verification'));

        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('templates.auth.verify');
    }

    /**
     * @return string
     */
    public function redirectTo()
    {
        return route('admin.index');
    }

    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if (! $request->user()->hasVerifiedEmail()) {
            alert()->html(
                __('Success'),
                __('A new verification link has been sent to :email.', ['email' => $request->user()->email]),
                'success'
            )->showConfirmButton();
        }

        return $this->traitResend($request);
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        $return = $this->traitVerify($request);
        if ($return instanceof Redirector) {
            alert()->html(
                __('Success'),
                __('Thank you, your e-mail address :email has been confirmed.', ['email' => $request->user()->email]),
                'success'
            )->showConfirmButton();
        }

        return $return;
    }
}
