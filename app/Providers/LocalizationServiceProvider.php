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
         setlocale(LC_TIME, currentLocale()['regional'] . '.UTF-8');
         Carbon::setLocale(app()->getLocale());
    }
}
