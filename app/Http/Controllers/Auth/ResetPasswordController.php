<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function showResetForm(Request $request, $token = null): View
    {
        SEOTools::setTitle(__('Define new password'));

        return $this->traitShowResetForm($request, $token);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $response
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function sendResetResponse(Request $request, $response)
    {
        alert()->html(__('Success'), __($response), 'success')->showConfirmButton();

        return $this->traitSendResetResponse($request, $response);
    }

    public function redirectPath(): string
    {
        return route('admin.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $response
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, string $response)
    {
        alert()->html(__('Error'), __($response), 'error')->showConfirmButton();

        return $this->traitSendResetFailedResponse($request, $response);
    }
}
