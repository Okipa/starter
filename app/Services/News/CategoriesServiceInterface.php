<?php

namespace App\Services\News;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface CategoriesServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table;
}
