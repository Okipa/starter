<?php

namespace App\Http\Requests\Traits;

use App\Models\PageContents\PageContent;

trait HasSeoMeta
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    protected function seoMetaRules(): array
    {
        return array_merge([
            'meta_image' => array_merge(['nullable'], app(PageContent::class)->getMediaValidationRules('seo')),
            'remove_meta_image' => ['required', 'boolean'],
        ], localizeRules([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
        ]));
    }

    protected function prepareSeoMetaRules(): void
    {
        $this->merge(['remove_meta_image' => (bool) $this->remove_meta_image]);
    }
}
