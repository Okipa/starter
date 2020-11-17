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

    public int $tries = 3;

    public function __construct(Carbon $validUntil)
    {
        $this->onQueue('high');
        parent::__construct($validUntil);
    }

    public function buildWelcomeNotificationMessage(): MailMessage
    {
        /** @var \App\Models\Users\User $user */
        $user = $this->user;

        return (new MailMessage())
            ->level('success')
            ->subject(__('Create your secured password'))
            ->greeting(__('Hello') . ' ' . $user->full_name . ',')
            ->line(__('Welcome on the :app platform. Your account has been created and in order to authenticate '
                . 'yourself, you first have to create a secured password.', ['app' => config('app.name')]))
            ->action(__('Create my secured password'), $this->showWelcomeFormUrl)
            ->line(__(
                'This link will expire in :minutes minutes.',
                ['minutes' => $this->validUntil->diffInRealMinutes()]
            ))
            ->line('  ')
            ->line(__('If you have not requested an account creation, no action is required.'));
    }

    protected function initializeNotificationProperties(User $user): void
    {
        /** @var \App\Models\Users\User $user */
        $this->user = $user;
        $this->user->welcome_valid_until = $this->validUntil;
        $this->user->save();
        $this->showWelcomeFormUrl = URL::signedRoute('password.welcome', ['user' => $user->id], $this->validUntil);
    }
}
