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
}
