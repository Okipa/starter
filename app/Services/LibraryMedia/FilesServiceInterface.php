<?php

namespace App\Services\LibraryMedia;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use Okipa\LaravelTable\Table;

interface FilesServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(Request $request): Table;

    /**
     * Inject javascript in the current view.
     *
     * @return void
     */
    public function injectJavascriptInView(): void;
}
