<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class LibraryMediaCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'title' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(app(LibraryMediaCategory::class)->getTable())
                    ->ignore($this->libraryMediaCategory->id),
            ],
        ]);
    }
}
