<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\Traits\HasSeoMeta;
use App\Models\Pages\Page;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    use HasSeoMeta;

    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
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

        return array_merge($rules, $localizedRules, $this->seoMetaRules());
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['active' => (bool) $this->active]);
        $this->prepareSeoMetaRules();
    }
}
