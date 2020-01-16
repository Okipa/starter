<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Spatie\WelcomeNotification\WelcomeNotification;

class InitializePassword extends WelcomeNotification implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    /** @inheritDoc */
    public function __construct(Carbon $validUntil)
    {
        $this->queue = 'high';
        parent::__construct($validUntil);
    }

    /** @inheritDoc */
    public function buildWelcomeNotificationMessage(): MailMessage
    {
        return (new MailMessage)
            ->subject(__('mails.InitializePassword.subject'))
            ->greeting(__('mails.notification.greeting.named', ['name' => $this->user->name]))
            ->line(__('mails.InitializePassword.message', ['app' => config('app.name')]))
            ->action(__('mails.InitializePassword.action'), $this->showWelcomeFormUrl)
            ->line(__('mails.InitializePassword.expiration', ['minutes' => $this->validUntil->diffInRealMinutes()]))
            ->line('  ')
            ->line(__('mails.InitializePassword.notice'));
    }

    /** @inheritDoc */
    protected function initializeNotificationProperties(User $user)
    {
        $this->user = $user;
        $this->user->welcome_valid_until = $this->validUntil;
        $this->user->save();
        $this->showWelcomeFormUrl = URL::signedRoute('password.welcome', ['user' => $user->id], $this->validUntil);
    }
}
