<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Traits\HasSeoMeta;
use Illuminate\Foundation\Http\FormRequest;

class NewsPageUpdateRequest extends FormRequest
{
    use HasSeoMeta;

    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        return $this->seoMetaRules();
    }

    public function prepareForValidation(): void
    {
        $this->prepareSeoMetaRules();
    }
}
