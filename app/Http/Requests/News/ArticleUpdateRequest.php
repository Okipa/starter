<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Abstracts\SeoRequest;
use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends SeoRequest
{
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
                UniqueTranslationRule::for(NewsArticle::class)->ignore($this->article),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['active' => (bool) $this->active]);
    }
}
