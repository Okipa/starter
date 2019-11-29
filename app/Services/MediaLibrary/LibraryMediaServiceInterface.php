<?php

namespace App\Services\MediaLibrary;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface LibraryMediaServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table;

    /**
     * Inject javascript in the current view.
     */
    public function injectJavascriptInView(): void;
}
