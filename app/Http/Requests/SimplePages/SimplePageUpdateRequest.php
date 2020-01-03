<?php

namespace App\Http\Requests\SimplePages;

use App\Http\Requests\Request;
use App\Services\Seo\SeoService;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class SimplePageUpdateRequest extends Request
{
    protected $exceptFromSanitize = ['url'];

    protected $safetyChecks = ['active' => 'boolean'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'active' => ['required', 'boolean'],
        ];
        $multilingualRules = $this->localizeRules(array_merge([
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('simple_pages')->ignore($this->simplePage->id),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
        ], (new SeoService)->getSeoMetaRules()));

        return array_merge($multilingualRules, $rules);
    }
}
