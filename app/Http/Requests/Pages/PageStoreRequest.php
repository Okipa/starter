<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\Traits\HasSeoMeta;
use App\Models\Pages\Page;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStoreRequest extends FormRequest
{
    use HasSeoMeta;

    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'unique_key' => ['required', 'snakecase', 'max:255', Rule::unique(Page::class)],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for(app(Page::class)->getTable()),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules, $this->seoMetaRules());
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['active' => (bool) $this->active]);
        $this->prepareSeoMetaRules();
    }
}
