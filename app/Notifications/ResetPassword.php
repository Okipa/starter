<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends \Illuminate\Auth\Notifications\ResetPassword implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

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
            ->subject(__('mails.ResetPassword.subject'))
            ->greeting(__('mails.notification.greeting.named', ['name' => $notifiable->name]))
            ->line(__('mails.ResetPassword.message'))
            ->action(__('mails.ResetPassword.action'), route('password.reset', [$this->token]))
            ->line(__('mails.ResetPassword.notice'));
    }
}
