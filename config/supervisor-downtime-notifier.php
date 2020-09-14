<?php

use NotificationChannels\Webhook\WebhookChannel;

return [

    /*
     * You can pass a boolean or a callable to authorize or block the notification process.
     * If the boolean or the callable return false, no notification will be sent.
     */
    'allowed_to_run' => env('APP_ENV') !== 'local',

    /*
     * The supervisor processes to check for each environment.
     * Each process will be checked with the `supervisorctl status` command,
     * which makes possible the use of wildcard.
     */
    'supervisor' => [
        'production' => [
            'sudo' => true,
            'processes' => [
                // todo: to customize
                // 'laravel-horizon-starter-production:*',

            ]
        ],
        'preprod' => [
            'sudo' => true,
            'processes' => [
                // todo: to customize
                // 'laravel-horizon-starter-preprod:*',
            ]
        ],
    ],

    /*
     * The downtime checker which will analyse each process and return the identified the down ones.
     * You may use your own supervisor checker but make sure you extends this one.
     */
    'supervisor_checker' => Okipa\LaravelSupervisorDowntimeNotifier\SupervisorChecker::class,

    /*
     * The notifiable to which the notification will be sent.
     * The default notifiable will use the mail, slack and webhook configuration specified in this config file.
     * You may use your own notifiable but make sure it extends this one.
     */
    'notifiable' => Okipa\LaravelSupervisorDowntimeNotifier\Notifiable::class,

    /*
     * The notification that will be sent when stuck jobs are detected.
     * You may use your own notifications but make sure they extend these ones.
     */
    'notifications' => [
        'service_not_started' => Okipa\LaravelSupervisorDowntimeNotifier\Notifications\ServiceNotStarted::class,
        'down_processes' => Okipa\LaravelSupervisorDowntimeNotifier\Notifications\ProcessesAreDown::class,
    ],

    /*
     * The callbacks that will be executed after the related events.
     * You may use your own callbacks but make sure they extend these ones.
     * Each callback be set to null if you do not want any to be executed.
     */
    'callbacks' => [
        'service_not_started' => Okipa\LaravelSupervisorDowntimeNotifier\Callbacks\OnServiceNotStarted::class,
        'down_processes' => Okipa\LaravelSupervisorDowntimeNotifier\Callbacks\OnDownProcesses::class,
    ],

    /*
     * The channels to which the notification will be sent.
     */
    // todo: to customize
    'channels' => [
        'mail',
        //'slack',
        //WebhookChannel::class
    ],

    'mail' => ['to' => env('MONITORING_EMAIL_NOTIFICATIONS')],

    // todo: to customize
    'slack' => ['webhookUrl' => 'https://your-slack-webhook.slack.com'],

    // Rocket chat webhook example
    // todo: to customize
    'webhook' => ['url' => 'https://rocket.chat/hooks/1234/5678'],


];
