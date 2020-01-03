<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords {
        showResetForm as traitShowResetForm;
        sendResetResponse as traitSendResetResponse;
        sendResetFailedResponse as traitSendResetFailedResponse;
    }

    /**
     * @inheritDoc
     */
    public function showResetForm(Request $request, $token = null)
    {
        SEOTools::setTitle(__('Define new password'));

        return $this->traitShowResetForm($request, $token);
    }

    /**
     * @inheritDoc
     */
    public function sendResetResponse(Request $request, $response)
    {
        alert()->html(__('Success'), __($response), 'success')->showConfirmButton();

        return $this->traitSendResetResponse($request, $response);
    }

    /**
     * @inheritDoc
     */
    public function redirectPath()
    {
        return route('admin.index');
    }

    /**
     * @inheritDoc
     */
    protected function sendResetFailedResponse(Request $request, string $response)
    {
        alert()->html(__('Error'), __($response), 'error')->showConfirmButton();

        return $this->traitSendResetFailedResponse($request, $response);
    }
}
