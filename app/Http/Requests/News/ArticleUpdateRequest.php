<?php

namespace App\Http\Requests\News;

use App\Http\Requests\SeoRequest;
use App\Models\News\NewsArticle;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class ArticleUpdateRequest extends SeoRequest
{
    public function rules(): array
    {
        $rules = [
            'illustration' => (new NewsArticle)->getMediaValidationRules('illustration'),
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:news_categories,id'],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('news_articles')->ignore($this->article->id),
            ],
            'description' => ['string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge([
            'published_at' => $this->published_at ? rescue(
                fn() => Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString(),
                'XXX',
                false
            ) : null,
            'active' => boolval($this->active),
        ]);
    }
}
