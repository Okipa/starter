<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageUpdateRequest;
use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    /**
     * @return View
     */
    public function edit(): View
    {
        /** @var PageContent $contactPageContent */
        $contactPageContent = (new PageContent)->where('slug', 'contact-page-content')->firstOrFail();
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('entities.contact'),
            'detail' => __('entities.page'),
        ]));

        return view('templates.admin.contact.page.edit', compact('contactPageContent'));
    }

    /**
     * @param ContactPageUpdateRequest $request
     *
     * @return RedirectResponse
     */
    public function update(ContactPageUpdateRequest $request): RedirectResponse
    {
        /** @var PageContent $contactPageContent */
        $contactPageContent = (new PageContent)->where('slug', 'contact-page-content')->firstOrFail();
        $contactPageContent->saveMetaFromRequest($request, ['title', 'description']);
        (new SeoService)->saveSeoTagsFromRequest($contactPageContent, $request);
        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.contact'),
            'name'   => __('entities.page'),
        ]));
    }
}
