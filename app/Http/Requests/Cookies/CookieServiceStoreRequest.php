<?php

namespace App\Http\Requests\Cookies;

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
            'cookies' => ['nullable'],
            'required' => ['required', 'boolean'],
            'enabled_by_default' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
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

    /** @throws \JsonException */
    public function prepareForValidation(): void
    {
        $this->merge([
            'cookies' => $this->get('cookies')
                ? json_decode($this->get('cookies'), true, 512, JSON_THROW_ON_ERROR)
                : null,
            'required' => (bool) $this->required,
            'enabled_by_default' => (bool) $this->enabled_by_default,
            'active' => (bool) $this->active,
        ]);
    }
}
