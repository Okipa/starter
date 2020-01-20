<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends \Illuminate\Auth\Notifications\ResetPassword implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    /**
     * Create a notification instance.
     *
     * @param string $token
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->queue = 'high';
        parent::__construct($token);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage|mixed
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(__('Reset your password'))
            ->greeting(__('mails.notification.greeting.named', ['name' => $notifiable->name]))
            ->line(__('mails.passwordReset.message'))
            ->action(__('mails.passwordReset.action'), route('password.update', [$this->token]))
            ->line(__('mails.passwordReset.notice'));
    }
}
