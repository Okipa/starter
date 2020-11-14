<?php

namespace App\Http\Requests\Abstracts;

use App\Models\Pages\PageContent;
use Illuminate\Foundation\Http\FormRequest;

abstract class SeoRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge([
            'meta_image' => array_merge(['nullable'], app(PageContent::class)->getMediaValidationRules('seo')),
            'remove_meta_image' => ['required', 'boolean'],
        ], localizeRules([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
        ]));
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['remove_meta_image' => (bool) $this->remove_meta_image]);
    }
}
