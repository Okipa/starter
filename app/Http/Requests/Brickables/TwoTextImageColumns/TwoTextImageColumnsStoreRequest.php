<?php

namespace App\Http\Requests\Brickables\TwoTextImageColumns;

use App\Models\Brickables\TwoTextImageColumnsBrick;
use Illuminate\Foundation\Http\FormRequest;

class TwoTextImageColumnsStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'image_right' => array_merge(
                ['required'],
                TwoTextImageColumnsBrick::getMediaValidationRules('images')
            ),
            'invert_order' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules(['text_left' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['invert_order' => (bool) $this->invert_order]);
    }
}
