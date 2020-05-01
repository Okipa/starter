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
        $this->onQueue('high');
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
            ->level('success')
            ->subject(__('Reset your password'))
            ->greeting(__('Hello') . ' ' . $notifiable->name . ',')
            ->line(__('This email has been sent to you because we have received a password reset request for your '
                . 'account.'))
            ->action(__('Reset password'), route('password.reset', [$this->token]))
            ->line(__('If you have not requested a password reset, no action is required.'));
    }
}
