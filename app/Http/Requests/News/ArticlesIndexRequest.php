<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['integer', 'exists:news_categories,id']];
    }
}
