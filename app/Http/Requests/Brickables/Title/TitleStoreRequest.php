<?php

namespace App\Http\Requests\Brickables\Title;

use App\View\Components\Front\Title as TitleComponent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TitleStoreRequest extends FormRequest
{
    /** @return array */
    public function rules(): array
    {
        $rules = [
            'type' => ['required', 'string', Rule::in(array_keys(TitleComponent::TYPES))],
            'style' => ['required', 'string', Rule::in(array_keys(TitleComponent::STYLES))],
        ];
        $localizeRules = localizeRules(['title' => ['required', 'string']]);

        return array_merge($rules, $localizeRules);
    }
}
