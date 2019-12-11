<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\HomePageUpdateRequest;
use App\Models\HomePage;
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
        /** @var \App\Models\HomePage $homePage */
        $homePage = (new HomePage)->firstOrFail();
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Home'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.home.page.edit', compact('homePage'));
    }

    /**
     * @param \App\Http\Requests\News\HomePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HomePageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\HomePage $homePage */
        $homePage = (new HomePage)->firstOrFail();
        $homePage->update($request->validated());
        (new SeoService)->saveSeoTagsFromRequest($homePage, $request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Home'),
            'name'   => __('Page'),
        ]));
    }
}
