<?php

namespace App\Http\Requests\DynamicPageBlocks;

use App\Models\DynamicPages\ParagraphImage;
use Illuminate\Foundation\Http\FormRequest;

class ParagraphImageStoreRequest extends FormRequest
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
                [ 'required' ],
                app(ParagraphImage::class)->validationConstraints('paragraph_images')
            ),
            'content' => 'required|string',
        ];
    }
}
