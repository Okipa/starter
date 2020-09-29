<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
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
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user) {
            // Todo: to customize.
            return auth()->check();
        });
    }
}
