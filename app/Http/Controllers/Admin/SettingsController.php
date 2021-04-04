<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUpdateRequest;
use App\Models\Settings\Settings;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Settings')]));

        return view('templates.admin.settings.edit', ['settings' => Settings::with(['media'])->sole()]);
    }

    /**
     * @param \App\Http\Requests\Settings\SettingsUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Exception
     */
    public function update(SettingsUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Settings\Settings $settings */
        $settings = Settings::sole();
        $settings->update($request->validated());
        if ($request->file('logo_square')) {
            $settings->addMediaFromRequest('logo_square')->toMediaCollection('logo_square');
        }
        settings(true);

        return back()->with('toast_success', __('crud.name.updated', [
            'name' => __('Settings'),
        ]));
    }
}
