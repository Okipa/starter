<?php

namespace App\Http\Requests\Brickables\OneColumnTextOneColumnImage;

use App\Models\Brickables\OneColumnTextOneColumnImageBrick;
use Illuminate\Foundation\Http\FormRequest;

class OneColumnTextOneColumnImageStoreRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'image_right' => array_merge(
                ['required'],
                app(OneColumnTextOneColumnImageBrick::class)->getMediaValidationRules('images')
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
