<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    /**
     * Create a notification instance.
     */
    public function __construct()
    {
        $this->queue = 'high';
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage|mixed
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(__('mails.emailVerification.subject'))
            ->greeting(__('mails.notification.greeting.named', ['name' => $notifiable->name]))
            ->line(__('mails.emailVerification.message'))
            ->action(__('mails.emailVerification.action'), $this->verificationUrl($notifiable))
            ->line(__('mails.emailVerification.notice'));
    }
}
