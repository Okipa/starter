<?php

namespace App\Http\Requests\LibraryMedia;

use App\Http\Requests\Request;
use App\Models\LibraryMediaFile;

class FileUpdateRequest extends Request
{
    protected $safetyChecks = ['downloadable' => 'boolean'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'integer', 'exists:library_media_categories,id'],
            'media' => array_merge(['required'], (new LibraryMediaFile)->validationConstraints('medias')),
            'downloadable' => ['required', 'boolean'],
        ];
        $multilingualRules = $this->localizeRules(['name' => ['required', 'string', 'max:255']]);

        return array_merge($multilingualRules, $rules);
    }
}
