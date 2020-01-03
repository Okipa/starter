<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

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

    /**
     * @inheritDoc
     */
    public function showLinkRequestForm()
    {
        SEOTools::setTitle(__('Forgotten password'));

        return $this->traitShowLinkRequestForm();
    }

    /**
     * @inheritDoc
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        alert()->html(__('Success'), __($response), 'success')->showConfirmButton();

        return $this->traitSendResetLinkResponse($request, $response);
    }

    /**
     * @inheritDoc
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        alert()->html(__('Error'), __($response), 'error')->showConfirmButton();

        return $this->traitSendResetLinkFailedResponse($request, $response);
    }
}
