<?php

namespace App\Http\Requests\SimplePages;

use App\Http\Requests\Request;
use App\Services\Seo\SeoService;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SimplePageStoreRequest extends Request
{
    protected $exceptFromSanitize = ['url'];

    protected $safetyChecks = ['active' => 'boolean'];

    /**
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        $this->merge(['slug' => Str::slug($this->slug)]);
    }

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
                UniqueTranslationRule::for('simple_pages'),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
        ], (new SeoService)->metaTagsRules()));

        return array_merge($multilingualRules, $rules);
    }
}
