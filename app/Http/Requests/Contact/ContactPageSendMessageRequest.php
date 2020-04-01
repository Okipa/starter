<?php

namespace App\Http\Requests\Contact;

use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;

class ContactPageSendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof'],
            'phone_number' => ['string', 'max:255', new PhoneInternational],
            'message' => ['required', 'string', 'max:65535'],
        ];
    }
}
