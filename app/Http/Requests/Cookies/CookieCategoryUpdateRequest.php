<?php

namespace App\Http\Requests\Cookies;

use App\Models\Cookies\CookieCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CookieCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'title' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(app(CookieCategory::class)->getTable())->ignore($this->cookieCategory->id),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);
    }
}
