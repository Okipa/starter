<?php

use NotificationChannels\Webhook\WebhookChannel;

return [

    /*
     * The number of days limit from which jobs will be considered as stuck.
     */
    'daysLimit'    => 2,

    /*
     * The notifiable to which the notification will be sent. The default
     * notifiable will use the mail and slack configuration specified
     * in this config file.
     */
    'notifiable'   => \Okipa\LaravelFailedJobsNotifier\Notifiable::class,

    /*
     * The notification that will be sent when stuck jobs are detected.
     */
    'notification' => \Okipa\LaravelFailedJobsNotifier\Notification::class,

    /*
    * You can pass a boolean or a callable to authorize or block the notification process.
    * If the boolean or the callable return false, no notification will be sent.
    */
    'allowedToRun' => env('APP_ENV') !== 'local',

    /*
     * The channels to which the notification will be sent.
     */

    // todo : customize this value
    'channels'     => [
        'mail',
        'slack',
        WebhookChannel::class,
    ],

    'mail' => [
        'to' => env('MONITORING_NOTIFICATIONS'),
    ],

    'slack' => [
        // todo : customize this value
        'webhook_url' => 'https://your-slack-webhook.slack.com',
    ],

    'webhook' => [
        // todo : customize this value
        // rocket chat example
        'url' => 'https://chat.acid.fr/hooks/1234/5678',
    ],

];
