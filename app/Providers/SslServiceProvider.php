<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class SslServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @param \Illuminate\Routing\UrlGenerator $url
     *
     * @return void
     */
    public function boot(UrlGenerator $url): void
    {
        if (in_array($this->app->environment(), ['preprod', 'production']) || config('app.force_https')) {
            $url->forceScheme('https');
        }
    }
}
