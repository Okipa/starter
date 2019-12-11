<?php

namespace DynamicPages\Services\DynamicPageBlocks;

use DynamicPages\Models\DynamicPage;
use App\Services\ServiceInterface;

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
