<?php

namespace DynamicPages;

use Illuminate\Support\ServiceProvider;

class DynamicPagesServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/dynamic-pages.php', 'dynamic-pages');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'dynamic-pages');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dynamic-pages');
    }
}
