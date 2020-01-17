<?php

namespace App\Http\Requests\Utils;

use App\Http\Requests\Request;

class DownloadFileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['path' => ['required', 'string'], 'name' => ['string']];
    }
}
