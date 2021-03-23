<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CookieServiceStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'category_ids' => ['required', 'array', Rule::in(CookieCategory::pluck('id'))],
            'unique_key' => ['required', 'slug', 'max:255', Rule::unique(CookieService::class)],
        ];
        $localizedRules = localizeRules([
            'title' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(app(CookieService::class)->getTable()),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
