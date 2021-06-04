<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Set Bootstrap pagination UI
        // More @ https://laravel.com/docs/pagination#using-bootstrap
        Paginator::useBootstrap();
        // Defined default password rule.
        // More @ https://laravel.com/docs/validation#defining-default-password-rules
        Password::defaults(fn() => Password::min(8)->uncompromised());
        // Trigger errors if eager loading is not correctly configured.
        // More @ https://laravel.com/docs/eloquent-relationships#preventing-lazy-loading
        Model::preventLazyLoading(! app()->isProduction());
    }
}
