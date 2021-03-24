<?php

namespace App\Http\Requests\Cookies;

use App\Models\Cookies\CookieCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CookieCategoriesReorderRequest extends FormRequest
{
    public function rules(): array
    {
        return ['ordered_ids' => ['required', 'array', Rule::in(CookieCategory::pluck('id'))]];
    }
}
