<?php

namespace App\Http\Requests\Brickables\OneTextColumnOneImageColumn;

use App\Models\Brickables\OneTextColumnOneImageColumnBrick;
use Illuminate\Foundation\Http\FormRequest;

class OneTextColumnOneImageColumnUpdateRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'image_right' => app(OneTextColumnOneImageColumnBrick::class)->getMediaValidationRules('images'),
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
