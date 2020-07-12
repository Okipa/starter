<?php

namespace App\Http\Requests\Brickables\TwoTextColumns;

use Illuminate\Foundation\Http\FormRequest;

class TwoTextColumnsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules(['text_left' => ['required', 'string'], 'text_right' => ['required', 'string']]);
    }
}
