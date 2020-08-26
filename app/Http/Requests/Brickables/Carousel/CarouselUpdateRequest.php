<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrick;
use Illuminate\Foundation\Http\FormRequest;

class CarouselUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return ['full_width' => ['required', 'boolean']];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['full_width' => (bool) $this->full_width]);
    }
}
