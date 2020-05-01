<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct()
    {
        $this->onQueue('high');
    }

    public function toMail($notifiable): MailMessage
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(__('Confirm your email address'))
            ->greeting(__('Hello') . ' ' . $notifiable->name . ',')
            ->line(__('To confirm your email address, please click the button below.'))
            ->action(__('Confirm my email address'), $this->verificationUrl($notifiable))
            ->line(__('If you have not created an account, no action is required.'));
    }
}
