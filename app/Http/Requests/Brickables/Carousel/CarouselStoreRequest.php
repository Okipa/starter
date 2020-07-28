<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrick;
use Illuminate\Foundation\Http\FormRequest;

class CarouselStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'full_width' => ['required', 'boolean'],
            'image' => array_merge(['required'], (new CarouselBrick)->getMediaValidationRules('slides')),
        ];
        $localizedRules = localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['full_width' => (bool) $this->full_width]);
    }
}
