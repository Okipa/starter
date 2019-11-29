<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUpdateRequest;
use Artesaos\SEOTools\Facades\SEOTools;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('entities.settings')]));

        return view('templates.admin.settings.edit');
    }

    /**
     * @param \App\Http\Requests\Settings\SettingsUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(SettingsUpdateRequest $request)
    {
        /** @var  Settings $settings */
        $settings = (new Settings)->firstOrFail();
        $settings->update($request->validated());
        if ($request->remove_icon) {
            $settings->clearMediaCollection('icon');
        } elseif ($request->file('icon')) {
            $settings->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        cache()->forever('settings', $settings->fresh());

        return back()->with('toast_success', __('notifications.message.crud.name.updated', [
            'name' => __('entities.settings'),
        ]));
    }
}
