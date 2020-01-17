<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;

class ArticlesIndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['category_id' => ['integer', 'exists:news_categories,id']];
    }
}
