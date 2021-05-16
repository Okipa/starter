<?php

namespace App\Http\Requests\Brickables\Title;

use App\Brickables\Title;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Okipa\LaravelBrickables\Models\Brick;

class TitleUpdateRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function rules(): array
    {
        if ($this->type === 'h1') {
            $h1Title = app($this->model_type)->find($this->model_id)
                ->getBricks([Title::class])
                ->filter(fn(Brick $titleBrick) => $titleBrick->id !== $this->brick->id
                    && $titleBrick['data']['type'] === 'h1');
            if ($h1Title->isNotEmpty()) {
                throw ValidationException::withMessages(['type' => [__('A h1 title has already been created.')]]);
            }
        }
        $rules = [
            'type' => ['required', 'string', Rule::in(array_keys(Title::TYPES))],
            'style' => ['required', 'string', Rule::in(array_keys(Title::STYLES))],
        ];
        $localizeRules = localizeRules(['title' => ['required', 'string']]);

        return array_merge($rules, $localizeRules);
    }
}
