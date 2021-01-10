<?php

namespace App\Http\Livewire;

use App\Models\Logs\LogContactFormMessage;
use App\Notifications\ContactFormMessage;
use App\Rules\PhoneInternational;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone_number = '';

    public string $message = '';

    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'message' => ['required', 'string', 'max:65535'],
        ];
    }

    /**
     * @param string $propertyName
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(): void
    {
        $this->validate();
        $this->sendMessage(settings()->email);
        $this->sendMessage($this->email, true);
        LogContactFormMessage::create(['data' => $this->getPublicPropertiesDefinedBySubClass()]);
        $this->reset();
        $this->dispatchBrowserEvent(
            'toast:success',
            ['title' => __('Your message has been sent, we have emailed you a copy.')]
        );
    }

    protected function sendMessage(string $email, bool $isCopyToSender = false): void
    {
        Notification::route('mail', $email)
            ->notify((new ContactFormMessage(
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->phone_number,
                $this->message,
                $isCopyToSender
            ))->locale(app()->getLocale()));
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
