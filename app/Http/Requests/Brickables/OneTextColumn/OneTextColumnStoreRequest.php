<?php

namespace App\Http\Requests\Brickables\OneTextColumn;

use Illuminate\Foundation\Http\FormRequest;

class OneTextColumnStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules(['text' => ['required', 'string']]);
    }
}
