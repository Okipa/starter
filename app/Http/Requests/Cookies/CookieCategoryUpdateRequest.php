<?php

namespace App\Http\Requests\Cookies;

use App\Models\Cookies\CookieCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CookieCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'unique_key' => [
                'required',
                'snakecase',
                'max:255',
                Rule::unique(CookieCategory::class)->ignore($this->cookieCategory),
            ],
        ];
        $localizedRules = localizeRules([
            'title' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(app(CookieCategory::class)->getTable())->ignore($this->cookieCategory->id),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
