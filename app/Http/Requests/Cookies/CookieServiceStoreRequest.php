<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\Cookies\CookieService;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CookieServiceStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'title' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(CookieService::class),
            ],
        ]);
    }
}
