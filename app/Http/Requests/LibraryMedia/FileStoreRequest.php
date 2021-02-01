<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileStoreRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'integer', Rule::exists(LibraryMediaCategory::class, 'id')],
            'media' => array_merge(['required'], app(LibraryMediaFile::class)->getMediaValidationRules('media')),
        ];
        $localizedRules = localizeRules(['name' => ['required', 'string', 'max:255']]);

        return array_merge($rules, $localizedRules);
    }
}
