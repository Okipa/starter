<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsPageUpdateRequest;
use App\Models\Pages\TitleDescriptionPageContent;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsPageController extends Controller
{
    public function edit(): View
    {
        $pageContent = (new TitleDescriptionPageContent)->firstOrCreate(['unique_key' => 'news_page_content']);
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
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->where('unique_key', 'news_page_content')->firstOrFail();
        $pageContent->saveSeoMetaFromRequest($request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('News'),
            'name' => __('Page'),
        ]));
    }
}
