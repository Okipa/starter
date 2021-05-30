<?php

namespace App\Http\Requests\Cookies;

use App\Models\Cookies\CookieCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CookieServicesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['nullable', 'integer', Rule::exists(CookieCategory::class, 'id')]];
    }
}
