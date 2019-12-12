<?php

namespace DynamicPages\Services\DynamicPageBlocks;

use App\Services\ServiceInterface;
use DynamicPages\Models\DynamicPage;

interface BlocksServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Okipa\LaravelTable\Table
     */
    public function table(DynamicPage $dynamicPage);
}
