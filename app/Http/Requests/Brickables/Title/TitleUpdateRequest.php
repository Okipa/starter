<?php

namespace App\Http\Requests\Brickables\Title;

use App\Brickables\Title;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TitleUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = ['type' => ['required', 'string', Rule::in(array_keys(Title::TYPES))]];
        $localizeRules = localizeRules(['title' => ['required', 'string']]);
        return array_merge($rules, $localizeRules);
    }
}
