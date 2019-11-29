<?php

namespace App\Services\SimplePages;

use App\Services\ServiceInterface;

interface PagesServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table();
}
