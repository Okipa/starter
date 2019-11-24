<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;

class LibraryMediaUpdateRequest extends Request
{
    protected $safetyChecks = [
        'downloadable' => 'boolean',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media'        => ['required', 'file'],
            'name'         => ['required', 'string', 'max:255'],
            'downloadable' => ['required', 'boolean'],
        ];
    }
}
