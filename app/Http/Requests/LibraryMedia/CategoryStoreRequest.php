<?php

namespace App\Http\Requests\LibraryMedia;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'name' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('library_media_categories'),
            ],
        ]);
    }
}
