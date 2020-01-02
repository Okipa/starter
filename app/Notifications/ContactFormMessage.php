<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormMessage extends Notification implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    protected $emailCopyStatus;

    protected $data;

    /**
     * Create a notification instance.
     *
     * @param string $emailCopyStatus
     * @param array $data
     */
    public function __construct(string $emailCopyStatus, array $data)
    {
        $this->queue = 'high';
        $this->emailCopyStatus = $emailCopyStatus;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        $mailMessage = (new MailMessage)
            ->subject(__('mails.ContactFormMessage.subject.' . $this->emailCopyStatus))
            ->greeting(__('mails.notification.greeting.default'))
            ->line(__('mails.ContactFormMessage.message.' . $this->emailCopyStatus, ['app' => config('app.name')]))
            ->line(' ')
            ->line('**' . __('validation.attributes.last_name') . ' :**  ' . $this->data['last_name'])
            ->line('**' . __('validation.attributes.first_name') . ' :** ' . $this->data['first_name'])
            ->line('**' . __('validation.attributes.email') . ' :** [' . $this->data['email']
                . '](mailto:' . $this->data['email'] . ')');
        $phoneNumber = data_get($this->data, 'phone_number');
        if ($phoneNumber) {
            $mailMessage->line('**' . __('validation.attributes.phone_number')
                . ' :**  [' . $phoneNumber . '](tel:' . $phoneNumber . ')');
        }
        $mailMessage->line('**' . __('validation.attributes.message') . ' :** «');
        $mailMessage->line($this->data['message']);
        $mailMessage->line(' »');

        return $mailMessage;
    }
}
