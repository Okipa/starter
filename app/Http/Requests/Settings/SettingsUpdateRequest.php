<?php

namespace App\Http\Requests\Settings;

use App\Models\Settings\Settings;
use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     * @throws \Exception
     */
    public function rules(): array
    {
        return [
            'logo_squared' => app(Settings::class)->getMediaValidationRules('logo_squared'),
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof'],
            'phone_number' => ['required', 'string', 'max:255', new PhoneInternational()],
            'address' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:255', 'url'],
            'twitter_url' => ['nullable', 'string', 'max:255', 'url'],
            'instagram_url' => ['nullable', 'string', 'max:255', 'url'],
            'youtube_url' => ['nullable', 'string', 'max:255', 'url'],
            'google_tag_manager_id' => ['nullable', 'string', 'max:255'],
        ];
    }
}
