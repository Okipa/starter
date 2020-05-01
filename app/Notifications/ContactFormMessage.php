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

    protected array $data;

    protected bool $isCopyToSender;

    public function __construct(array $data, bool $isCopyToSender = false)
    {
        $this->onQueue('high');
        $this->isCopyToSender = $isCopyToSender;
        $this->data = $data;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject($this->isCopyToSender ? __('Copy of your sent message') : __('New message from the contact form'))
            ->line(__($this->isCopyToSender
                ? 'Here is a copy of your message, sent from the contact form of :app.'
                : 'This message has been sent to you from the contact form of :app.', ['app' => config('app.name')]))
            ->line(' ')
            ->line('**' . __('validation.attributes.last_name') . ' :**  ' . $this->data['last_name'])
            ->line('**' . __('validation.attributes.first_name') . ' :** ' . $this->data['first_name'])
            ->line('**' . __('validation.attributes.email') . ' :** [' . $this->data['email']
                . '](mailto:' . $this->data['email'] . ')');
        if (data_get($this->data, 'phone_number')) {
            $mailMessage->line('**' . __('Phone number:') . '**  [' . data_get($this->data, 'phone_number') . ']'
                . '(tel:' . data_get($this->data, 'phone_number') . ')');
        }
        $mailMessage->line('**' . __('validation.attributes.message') . ' :** «');
        $mailMessage->line($this->data['message']);
        $mailMessage->line(' »');

        return $mailMessage;
    }
}
