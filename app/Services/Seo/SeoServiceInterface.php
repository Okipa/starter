<?php

namespace App\Services\Seo;

use App\Models\Metable;
use App\Services\ServiceInterface;
use Illuminate\Http\Request;

interface SeoServiceInterface extends ServiceInterface
{
    /**
     * Get SEO meta rules.
     *
     * @return array
     */
    public function getSeoMetaRules(): array;

    /**
     * Save SEO meta from request.
     *
     * @param Metable $model
     * @param Request $request
     */
    public function saveSeoTagsFromRequest(Metable $model, Request $request): void;

    /**
     * Save SEO meta for model from given array.
     *
     * @param \App\Models\Metable $model
     * @param array $values
     */
    public function saveSeoTags(Metable $model, array $values): void;

    /**
     * Display SEO meta in the HTML head from model.
     *
     * @param \App\Models\Metable $model
     */
    public function displayMetaTagsFromModel(Metable $model): void;
}
