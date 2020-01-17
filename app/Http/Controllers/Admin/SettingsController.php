<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUpdateRequest;
use App\Models\Settings\Settings;
use Artesaos\SEOTools\Facades\SEOTools;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Settings')]));

        return view('templates.admin.settings.edit');
    }

    /**
     * @param \App\Http\Requests\Settings\SettingsUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Exception
     */
    public function update(SettingsUpdateRequest $request)
    {
        /** @var \App\Models\Settings\Settings $settings */
        $settings = (new Settings)->firstOrFail();
        $settings->update($request->validated());
        if ($request->remove_icon) {
            $settings->clearMediaCollection('icon');
        } elseif ($request->file('icon')) {
            $settings->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        settings(true);

        return back()->with('toast_success', __('notifications.name.updated', [
            'name' => __('Settings'),
        ]));
    }
}
