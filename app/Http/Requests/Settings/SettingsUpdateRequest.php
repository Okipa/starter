<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;

class SettingsUpdateRequest extends Request
{
    protected $exceptFromSanitize = ['phone_number', 'zip_code'];

    protected $safetyChecks = ['remove_icon' => 'boolean'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Exception
     */
    public function rules()
    {
        return [
            'icon' => cache('settings')->validationConstraints('icon'),
            'remove_icon' => ['required', 'boolean'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'phone_number' => ['required', 'string', 'max:255', 'phone:AUTO'],
            'address' => ['string', 'max:255'],
            'zip_code' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'facebook' => ['string', 'max:255', 'url'],
            'instagram' => ['string', 'max:255', 'url'],
            'google_tag_manager_id' => ['string', 'max:255'],
        ];
    }
}
