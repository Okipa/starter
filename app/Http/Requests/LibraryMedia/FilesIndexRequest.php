<?php

namespace App\Http\Requests\LibraryMedia;

use App\Http\Requests\Request;

class FilesIndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['category_id' => ['integer', 'exists:library_media_categories,id']];
    }
}
