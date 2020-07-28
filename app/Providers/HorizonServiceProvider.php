<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
        // Horizon::routeSmsNotificationsTo('15556667777');
        $mailNotificationsRecipients = config('notifications.recipients.monitoring.email');
        if ($mailNotificationsRecipients) {
            Horizon::routeMailNotificationsTo($mailNotificationsRecipients);
        }
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
         Horizon::night();
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user) {
            // todo: customize access in production
            return auth()->check();
        });
    }
}
