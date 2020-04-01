<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhoneInternational implements Rule
{
    /**
     * @param $attribute
     * @param $value
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $localizedPhoneNumber = Str::replaceFirst('0', '+33', $value);

        return ! Validator::make(
            ['phone_number_validation' => $localizedPhoneNumber],
            ['phone_number_validation' => 'phone:AUTO']
        )->fails();
    }

    public function message(): string
    {
        return __('validation.phone_international');
    }
}
