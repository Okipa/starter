<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsPageUpdateRequest;
use App\Models\PageContents\PageContent;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class NewsPageController extends Controller
{
    public function edit(): View
    {
        $pageContent = PageContent::where('unique_key', 'news_page_content')->sole();
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('News'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.news.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\News\NewsPageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(NewsPageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\PageContents\PageContent $pageContent */
        $pageContent = PageContent::where('unique_key', 'news_page_content')->sole();
        $pageContent->saveSeoMetaFromRequest($request);

        return back()->with('toast_success', __('crud.orphan.updated', [
            'entity' => __('News'),
            'name' => __('Page'),
        ]));
    }
}
