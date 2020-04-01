<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails {
        showLinkRequestForm as traitShowLinkRequestForm;
        sendResetLinkResponse as traitSendResetLinkResponse;
        sendResetLinkFailedResponse as traitSendResetLinkFailedResponse;
    }

    public function showLinkRequestForm(): Response
    {
        SEOTools::setTitle(__('Forgotten password'));

        return $this->traitShowLinkRequestForm();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $response
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse(Request $request, string $response)
    {
        alert()->html(__('Success'), __($response), 'success')->showConfirmButton();

        return $this->traitSendResetLinkResponse($request, $response);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $response
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, string $response)
    {
        alert()->html(__('Error'), __($response), 'error')->showConfirmButton();

        return $this->traitSendResetLinkFailedResponse($request, $response);
    }
}
