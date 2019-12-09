<?php

namespace App\Http\Requests\DynamicPages;

use App\Http\Requests\Request;
use App\Rules\UrlUnique;
use App\Services\Seo\SeoService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DynamicPageStoreRequest extends Request
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
        $this->merge([
            'slug' => Str::slug($this->slug),
            'url'  => $this->url ? strtolower($this->url) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'slug'        => ['required', 'string', 'alpha_dash', 'max:255', 'unique:dynamic_pages,slug'],
            'url'         => ['required', 'string', 'max:255', 'unique:dynamic_pages,url', new UrlUnique],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
            'active'      => ['required', 'boolean'],
        ], (new SeoService)->metaTagsRules());
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $customValidator = Validator::make([
            'full_url' => $this->url ? route('dynamicPage.show', $this->url) : null,
        ], [
            'full_url' => ['required', 'string', 'url'],
        ]);
        if ($customValidator->failed()) {
            $validator->after(function ($validator) {
                $validator->errors()->add('url', __('validation.url'));
            });
        }
    }
}
