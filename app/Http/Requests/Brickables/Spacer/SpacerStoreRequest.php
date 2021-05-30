<?php

namespace App\Http\Requests\Brickables\Spacer;

use App\View\Components\Front\Spacer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpacerStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return ['type' => ['required', 'string', Rule::in(array_keys(Spacer::TYPES))]];
    }
}
