<?php

namespace App\Http\Requests\News;

use App\Models\News\NewsCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticlesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['nullable', 'integer', Rule::exists(NewsCategory::class, 'id')]];
    }
}
