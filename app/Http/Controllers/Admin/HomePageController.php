<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomePageUpdateRequest;
use App\Models\Pages\PageContent;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class HomePageController extends Controller
{
    public function edit(): View
    {
        $pageContent = PageContent::where('unique_key', 'home_page_content')->sole();
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Home'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.home.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\Home\HomePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(HomePageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = PageContent::where('unique_key', 'home_page_content')->sole();
        $pageContent->saveSeoMetaFromRequest($request);

        return back()->with('toast_success', __('crud.orphan.updated', [
            'entity' => __('Home'),
            'name' => __('Page'),
        ]));
    }
}
