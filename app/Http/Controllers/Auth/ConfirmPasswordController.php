<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Response;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords {
        showConfirmForm as traitShowConfirmForm;
    }

    public function showConfirmForm(): Response
    {
        SEOTools::setTitle(__('Password verification'));

        return $this->traitShowConfirmForm();
    }

    public function redirectPath(): string
    {
        return route('admin.index');
    }
}
