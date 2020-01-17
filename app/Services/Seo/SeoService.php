<?php

namespace App\Services\Seo;

use App\Models\Metable;
use App\Services\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class SeoService extends Service implements SeoServiceInterface
{
    protected $seoTags = ['meta_title', 'meta_description'];

    /**
     * Get SEO meta rules.
     *
     * @return array
     */
    public function getSeoMetaRules(): array
    {
        return ['meta_title' => ['required', 'string', 'max:255'], 'meta_description' => ['string', 'max:255']];
    }

    /**
     * Save SEO meta from request.
     *
     * @param Metable $model
     * @param Request $request
     */
    public function saveSeoTagsFromRequest(Metable $model, Request $request): void
    {
        $model->saveMetaFromRequest($request, $this->seoTags);
    }

    /**
     * Save SEO meta for model from given array.
     *
     * @param \App\Models\Metable $model
     * @param array $values
     */
    public function saveSeoTags(Metable $model, array $values): void
    {
        foreach ($this->seoTags as $tag) {
            if ($model->hasMeta($tag)) {
                $model->removeMeta($tag);
            }
            if (! empty(data_get($values, $tag))) {
                $model->setMeta($tag, data_get($values, $tag));
            }
        }
    }

    /**
     * Display SEO meta in the HTML head from model.
     *
     * @param \App\Models\Metable $model
     */
    public function displayMetaTagsFromModel(Metable $model): void
    {
        SEOTools::setTitle($model->getMeta('meta_title'));
        SEOTools::setDescription($model->getMeta('meta_description'));
    }
}
