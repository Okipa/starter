<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // time localization
        // todo : fix this
        // setlocale(LC_TIME, LaravelLocalization::getCurrentLocaleRegional() . '.UTF-8');
        Carbon::setLocale(app()->getLocale());
    }
}
