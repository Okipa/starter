<?php

namespace App\Http\Requests\Brickables\ColoredBackgroundContainer;

use App\Brickables\ColoredBackgroundContainer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColoredBackgroundContainerStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_width' => ['required', 'boolean'],
            'background_color' => [
                'required',
                'string',
                Rule::in(array_keys(ColoredBackgroundContainer::BACKGROUND_COLORS)),
            ],
            'alignment' => [
                'required',
                'string',
                Rule::in(array_keys(ColoredBackgroundContainer::ALIGNMENTS)),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['full_width' => (bool) $this->full_width]);
    }
}
