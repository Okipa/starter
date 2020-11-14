<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Foundation\Http\FormRequest;

class FileStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'integer', 'exists:' . LibraryMediaFile::class . ',id'],
            'media' => array_merge(['required'], app(LibraryMediaFile::class)->getMediaValidationRules('media')),
        ];
        $localizedRules = localizeRules(['name' => ['required', 'string', 'max:255']]);

        return array_merge($rules, $localizedRules);
    }
}
