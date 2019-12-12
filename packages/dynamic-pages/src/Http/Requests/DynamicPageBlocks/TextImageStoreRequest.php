<?php

namespace DynamicPages\Http\Requests\DynamicPageBlocks;

use DynamicPages\Models\Blockables\TextImage;
use Illuminate\Foundation\Http\FormRequest;

class TextImageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'   => array_merge(
                ['required'],
                app(TextImage::class)->validationConstraints('text_images')
            ),
            'content' => 'required|string',
        ];
    }
}
