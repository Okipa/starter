<?php

namespace App\Services\DynamicPageBlocks;

use App\Models\DynamicPage;
use App\Services\ServiceInterface;

interface BlocksServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Okipa\LaravelTable\Table
     */
    public function table(DynamicPage $dynamicPage);
}
