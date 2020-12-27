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
    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $phone_number = null;

    public ?string $message = null;

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'message' => ['required', 'string', 'max:65535'],
        ];
    }

    /**
     * @param string $fieldName
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated(string $fieldName): void
    {
        $this->validateOnly($fieldName);
    }

    public function sendMessage(): void
    {
        $validated = $this->validate();
        $this->sendMessageTo(settings()->email, $validated);
        $this->sendMessageTo($validated['email'], $validated, true);
        LogContactFormMessage::create(['data' => $validated]);
        $this->reset();
        $this->dispatchBrowserEvent('toast:success', [
            'title' => __('Your message has been sent, we have emailed you a copy.'),
        ]);
    }

    protected function sendMessageTo(string $email, array $data, bool $isCopyToSender = false): void
    {
        Notification::route('mail', $email)
            ->notify((new ContactFormMessage(
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['phone_number'],
                $data['message'],
                $isCopyToSender
            ))->locale(app()->getLocale()));
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
