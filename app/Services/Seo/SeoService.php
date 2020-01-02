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
     * @return array
     */
    public function metaTagsRules(): array
    {
        return [
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ];
    }

    /**
     * @param Metable $model
     * @param Request $request
     */
    public function saveSeoTagsFromRequest(Metable $model, Request $request): void
    {
        $model->saveMetaFromRequest($request, $this->seoTags);
    }

    /**
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
     * @param \App\Models\Metable $model
     */
    public function displayMetaTagsFromModel(Metable $model): void
    {
        SEOTools::setTitle($model->getMeta('meta_title'));
        SEOTools::setDescription($model->getMeta('meta_description'));
    }
}
