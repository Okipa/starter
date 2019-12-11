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
     * @return Factory|View
     */
    public function index()
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Settings')]));

        return view('templates.admin.settings.edit');
    }

    /**
     * @param SettingsUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws Exception
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
