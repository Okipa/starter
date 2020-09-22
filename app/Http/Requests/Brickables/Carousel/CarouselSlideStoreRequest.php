<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrickSlide;
use Illuminate\Foundation\Http\FormRequest;

class CarouselSlideStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'image' => array_merge(['required'], CarouselBrickSlide::getMediaValidationRules('images')),
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'label' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['active' => (bool) $this->active]);
    }
}
