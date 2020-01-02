<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\Request;

class ContactPageSendMessageRequest extends Request
{
    protected $exceptFromSanitize = ['phone_number'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['phone:AUTO', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:65535'],
        ];
    }
}
