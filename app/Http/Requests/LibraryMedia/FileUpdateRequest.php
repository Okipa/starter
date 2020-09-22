<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'integer', 'exists:library_media_categories,id'],
            'media' => LibraryMediaFile::getMediaValidationRules('media'),
        ];
        $localizedRules = localizeRules(['name' => ['required', 'string', 'max:255']]);

        return array_merge($rules, $localizedRules);
    }
}
