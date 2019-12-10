<?php

namespace App\Http\Requests;

use Okipa\LaravelRequestSanitizer\RequestSanitizer;

class Request extends RequestSanitizer
{
    /**
     * Translate rules for each activated language.
     *
     * @param array $rules
     *
     * @return array
     */
    protected function localizeRules(array $rules): array
    {
        $localizedRules = [];
        foreach ($rules as $ruleKey => $ruleDetails) {
            foreach (config('localized-routes.supported-locales') as $localCode) {
                $localizedRules[$ruleKey . '.' . $localCode] = $ruleDetails;
            }
        }

        return $localizedRules;
    }
}
