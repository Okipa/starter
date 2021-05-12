<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageUpdateRequest;
use App\Models\PageContents\PageContent;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ContactPageController extends Controller
{
    public function edit(): View
    {
        $pageContent = PageContent::where('unique_key', 'contact_page_content')->sole();
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
        /** @var \App\Models\PageContents\PageContent $pageContent */
        $pageContent = PageContent::where('unique_key', 'contact_page_content')->sole();
        $pageContent->saveSeoMetaFromRequest($request);

        return back()->with('toast_success', __('crud.orphan.updated', [
            'entity' => __('Contact'),
            'name' => __('Page'),
        ]));
    }
}
