<?php

namespace App\Http\Requests\LibraryMedia;

use App\Http\Requests\Request;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CategoryStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->localizeRules([
            'name' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('library_media_categories'),
            ],
        ]);
    }
}
