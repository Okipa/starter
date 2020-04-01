<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageUpdateRequest;
use App\Models\Pages\TitleDescriptionPageContent;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    public function edit(): View
    {
        $pageContent = (new TitleDescriptionPageContent)->firstOrCreate(['slug' => 'contact-page-content']);
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Contact'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.contact.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\Contact\ContactPageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(ContactPageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->where('slug', 'contact-page-content')->firstOrFail();
        $pageContent->saveSeoMetaFromRequest($request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Contact'),
            'name' => __('Page'),
        ]));
    }
}
