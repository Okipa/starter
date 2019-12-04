<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Okipa\LaravelRequestSanitizer\RequestSanitizer;

class Request extends RequestSanitizer
{
    /**
     * Create the default validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        $rules = $this->container->call([$this, 'rules']);
        if (count(LaravelLocalization::getSupportedLocales()) > 1) {
            $rules = $this->translatedRules($rules);
        }

        return $factory->make($this->validationData(), $rules, $this->messages(), $this->attributes());
    }

    /**
     * Translate rules for each activated language.
     *
     * @param array $rules
     *
     * @return array
     */
    protected function translatedRules(array $rules): array
    {
        $translatedRules = [];
        foreach ($rules as $ruleKey => $ruleDetails) {
            foreach (array_keys(LaravelLocalization::getLocalesOrder()) as $localCode) {
                $translatedRules[$ruleKey . '_' . $localCode] = $ruleDetails;
            }
        }

        return $translatedRules;
    }
}
