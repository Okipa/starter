<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\PageStoreRequest;
use App\Http\Requests\Pages\PageUpdateRequest;
use App\Models\Pages\Page;
use App\Services\Pages\PagesService;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Arr;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $table = (new PagesService)->table();
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Pages')]));

        return view('templates.admin.pages.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Pages')]));

        return view('templates.admin.pages.edit', compact('page'));
    }

    /**
     * @param \App\Http\Requests\Pages\PageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PageStoreRequest $request)
    {
        $page = (new Page)->create($request->validated());
        (new SeoService)->saveSeoTagsFromRequest($page, $request);
        pages(true);

        return redirect()->route('pages.index')->with('toast_success', __('notifications.orphan.created', [
            'entity' => __('Pages'),
            'name' => $page->title,
        ]));
    }

    /**
     * @param \App\Models\Pages\Page $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Pages'),
            'detail' => $page->title,
        ]));

        return view('templates.admin.pages.edit', compact('page'));
    }

    /**
     * @param \App\Models\Pages\Page $page
     * @param \App\Http\Requests\Pages\PageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Page $page, PageUpdateRequest $request)
    {
        $page->update(Arr::except($request->validated(), 'slug'));
        (new SeoService)->saveSeoTagsFromRequest($page, $request);
        pages(true);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Pages'),
            'name' => $page->title,
        ]));
    }

    /**
     * @param \App\Models\Pages\Page $page
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $name = $page->title;
        $page->delete();
        pages(true);

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Pages'),
            'name' => $name,
        ]));
    }
}
