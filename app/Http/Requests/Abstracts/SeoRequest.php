<?php

namespace App\Http\Requests;

use App\Models\Pages\PageContent;
use Illuminate\Foundation\Http\FormRequest;

abstract class SeoRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge([
            'meta_image' => (new PageContent)->getMediaValidationRules('seo'),
            'remove_meta_image' => ['required', 'boolean'],
        ], localizeRules([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ]));
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['remove_meta_image' => boolval($this->remove_meta_image)]);
    }
}
