<?php

namespace App\Http\Requests\Utils;

use Illuminate\Foundation\Http\FormRequest;

class DownloadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return ['path' => ['required', 'string'], 'name' => ['string']];
    }
}
