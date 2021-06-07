<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Traits\HasSeoMeta;
use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsArticleUpdateRequest extends FormRequest
{
    use HasSeoMeta;

    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'illustration' => app(NewsArticle::class)->getMediaValidationRules('illustrations'),
            'category_ids' => ['required', 'array', Rule::in(NewsCategory::pluck('id'))],
            'published_at' => ['required', 'date'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for(app(NewsArticle::class)->getTable())->ignore($this->article->id),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, $this->seoMetaRules());
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['active' => (bool) $this->active]);
        $this->prepareSeoMetaRules();
    }
}
