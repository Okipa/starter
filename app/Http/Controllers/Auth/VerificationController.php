<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Artesaos\SEOTools\Facades\SEOTools;
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
        return route('home');
    }

    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function resend(Request $request)
    {
        if (! $request->user()->hasVerifiedEmail()) {
            alert()->html(
                __('Success'),
                __('notifications.message.auth.verificationEmailSent', ['email' => $request->user()->email]),
                'success'
            )->showConfirmButton();
        }

        return $this->traitResend($request);
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param Request $request
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function verify(Request $request)
    {
        alert()->html(
            __('Success'),
            __('notifications.message.auth.emailVerified', ['email' => $request->user()->email]),
            'success'
        )->showConfirmButton();

        return $this->traitVerify($request);
    }
}
