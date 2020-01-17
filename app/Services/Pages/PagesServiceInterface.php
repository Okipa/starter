<?php

namespace App\Services\Pages;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface PagesServiceInterface extends ServiceInterface
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
