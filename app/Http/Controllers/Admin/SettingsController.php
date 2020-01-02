<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUpdateRequest;
use App\Models\Settings;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
     */
    public function update(SettingsUpdateRequest $request)
    {
        cache()->forget('settings');
        /** @var Settings $settings */
        $settings = (new Settings)->firstOrFail();
        $settings->update($request->validated());
        if ($request->remove_icon) {
            $settings->clearMediaCollection('icon');
        } elseif ($request->file('icon')) {
            $settings->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        cache()->forever('settings', $settings->fresh());

        return back()->with('toast_success', __('notifications.name.updated', [
            'name' => __('Settings'),
        ]));
    }
}
