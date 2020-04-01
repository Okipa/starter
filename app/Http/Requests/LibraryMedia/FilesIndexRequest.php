<?php

namespace App\Http\Requests\LibraryMedia;

use Illuminate\Foundation\Http\FormRequest;

class FilesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['integer', 'exists:library_media_categories,id']];
    }
}
