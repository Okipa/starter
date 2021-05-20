<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormMessage extends Notification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public string $firstName;

    public string $lastName;

    public string $email;

    public ?string $phoneNumber = null;

    public string $message;

    public bool $isCopyToSender;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        ?string $phoneNumber,
        string $message,
        bool $isCopyToSender = false
    ) {
        $this->onQueue('high');
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
        $this->isCopyToSender = $isCopyToSender;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        $mailMessage = (new MailMessage())
            ->level('success')
            ->subject($this->isCopyToSender
                ? __('Copy of your sent message')
                : __('New message from the contact form'));
        if ($this->isCopyToSender) {
            $mailMessage->greeting(__('Hello') . ' ' . $this->firstName . ' ' . $this->lastName . ',');
        }
        $mailMessage->line(__($this->isCopyToSender
            ? 'Here is a copy of your message, sent from the contact form of :app.'
            : 'This message has been sent to you from the contact form of :app.', ['app' => config('app.name')]))
            ->line(' ')
            ->line('**' . __('validation.attributes.last_name') . ' :**  ' . $this->lastName)
            ->line('**' . __('validation.attributes.first_name') . ' :** ' . $this->firstName)
            ->line('**' . __('validation.attributes.email')
                . ' :** [' . $this->email . '](mailto:' . $this->email . ')');
        if ($this->phoneNumber) {
            $mailMessage->line('**' . __('Phone number:') . '**  [' . $this->phoneNumber . ']'
                . '(tel:' . $this->phoneNumber . ')');
        }
        $mailMessage->line('**' . __('validation.attributes.message') . ' :** «');
        $messageLines = explode('<br />', nl2br($this->message));
        foreach (array_filter($messageLines) as $line) {
            $mailMessage->line($line);
        }
        $mailMessage->line(' »');

        return $mailMessage;
    }
}
