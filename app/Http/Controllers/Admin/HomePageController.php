<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\HomePageUpdateRequest;
use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'home-page-content']);
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Home'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.home.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\News\HomePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HomePageUpdateRequest $request): RedirectResponse
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->where('slug', 'home-page-content')->firstOrFail();
        $pageContent->saveMetaFromRequest($request, ['title', 'description']);
        (new SeoService)->saveSeoTagsFromRequest($pageContent, $request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Home'),
            'name' => __('Page'),
        ]));
    }
}
