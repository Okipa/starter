<?php

namespace App\Services\Seo;

use App\Services\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SeoService extends Service implements SeoServiceInterface
{
    /**
     * @return array
     */
    public function metaTagsRules(): array
    {
        return [
            'meta_title'       => ['required', 'string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request $request
     */
    public function saveMetaTagsFromRequest(Model $model, Request $request): void
    {
        $this->saveMetaTags($model, $request->only('meta_title', 'meta_description'));
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $metaTags
     */
    public function saveMetaTags(Model $model, array $metaTags): void
    {
        if (method_exists($model, 'syncMeta')) {
            $model->syncMeta([]);
        }
        if (method_exists($model, 'setMeta') && Arr::has($metaTags, 'meta_title')) {
            $model->setMeta('meta_title', $metaTags['meta_title']);
        }
        if (method_exists($model, 'setMeta') && Arr::has($metaTags, 'meta_description')) {
            $model->setMeta('meta_description', $metaTags['meta_description']);
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function displayMetaTagsFromModel(Model $model): void
    {
        if (method_exists($model, 'getMeta')) {
            SEOTools::setTitle($model->getMeta('meta_title'));
            SEOTools::setDescription($model->getMeta('meta_description'));
        }
    }
}
