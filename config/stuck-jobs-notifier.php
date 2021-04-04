<?php

return [

    /*
     * You can pass a boolean or a callable to authorize or block the notification process.
     * If the boolean or the callable return false, no notification will be sent.
     */
    'allowed_to_run' => env('APP_ENV') !== 'local',

    /*
     * The number of hours from which the failed jobs are considered as stuck.
     */
    'hours_limit' => 2,

    /*
     * The notifiable to which the notification will be sent.
     * The default notifiable will use the mail, slack and webhook configuration specified in this config file.
     * You may use your own notifiable but make sure it extends this one.
     */
    'notifiable' => Okipa\LaravelStuckJobsNotifier\Notifiable::class,

    /*
     * The notification that will be sent when stuck jobs are detected.
     * You may use your own notification but make sure it extends this one.
     */
    'notification' => Okipa\LaravelStuckJobsNotifier\Notifications\JobsAreStuck::class,

    /*
     * The callback that will be executed when stuck jobs are detected.
     * You may use your own callback but make sure it extends this one.
     * Can be set to null if you do not want any callback to be executed.
     */
    'callback' => Okipa\LaravelStuckJobsNotifier\Callbacks\OnStuckJobs::class,

    /*
     * The channels to which the notification will be sent.
     */
    // ToDo: to customize.
    'channels' => [
        'mail',
        // 'slack', // Requires laravel/slack-notification-channel package
        NotificationChannels\Webhook\WebhookChannel::class,
    ],

    'mail' => [
        'to' => env('MONITORING_EMAIL_NOTIFICATIONS'),
    ],

    // ToDo: to customize.
    'slack' => [
        'webhookUrl' => 'https://your-slack-webhook.slack.com',
    ],

    // Rocket chat webhook example
    // ToDo: to customize.
    'webhook' => [
        'url' => 'https://rocket.chat/hooks/1234/5678',
    ],

];
