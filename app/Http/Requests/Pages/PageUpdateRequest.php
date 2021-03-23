<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\Abstracts\SeoRequest;
use App\Models\Pages\Page;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageUpdateRequest extends SeoRequest
{
    public function rules(): array
    {
        $rules = ['active' => ['required', 'boolean']];
        $localizedRules = localizeRules([
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for(app(Page::class)->getTable())->ignore($this->page->id),
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
