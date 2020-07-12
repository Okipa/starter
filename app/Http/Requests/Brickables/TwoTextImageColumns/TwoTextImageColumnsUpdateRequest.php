<?php

namespace App\Http\Requests\Brickables\TwoTextImageColumns;

use Illuminate\Foundation\Http\FormRequest;

class TwoTextImageColumnsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var \App\Models\Brickables\TwoTextImageColumnsBrick $model */
        $model = $this->getBrickModel();
        $rules = [
            'right_image' => $model->getMediaValidationRules('images'),
            'invert_order' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules(['text_left' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation()
    {
        $this->merge(['invert_order' => (bool) $this->invert_order]);
    }
}
