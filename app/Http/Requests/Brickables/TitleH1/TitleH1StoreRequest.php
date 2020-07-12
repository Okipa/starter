<?php

namespace App\Http\Requests\Brickables\TitleH1;

use Illuminate\Foundation\Http\FormRequest;

class TitleH1StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules(['title' => ['required', 'string']]);
    }
}
