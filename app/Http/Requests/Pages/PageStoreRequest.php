<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\AbstractSeoRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageStoreRequest extends AbstractSeoRequest
{
    public function rules(): array
    {
        $rules = [
            'unique_key' => ['required', 'snakecase',  'max:255', 'unique:pages'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for('pages'),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['active' => (bool) $this->active]);
    }
}
