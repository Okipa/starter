<?php

namespace App\Http\Requests\Brickables\ThreeTextColumns;

use Illuminate\Foundation\Http\FormRequest;

class ThreeTextColumnsStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'text_left' => ['required', 'string'],
            'text_center' => ['required', 'string'],
            'text_right' => ['required', 'string'],
        ]);
    }
}
