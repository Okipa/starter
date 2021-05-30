<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\PageStoreRequest;
use App\Http\Requests\Pages\PageUpdateRequest;
use App\Models\Pages\Page;
use App\Tables\PagesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = app(PagesTable::class)->setup();
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Free pages')]));

        return view('templates.admin.pages.index', compact('table'));
    }

    public function create(): View
    {
        $page = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Free pages')]));

        return view('templates.admin.pages.edit', compact('page'));
    }

    /**
     * @param \App\Http\Requests\Pages\PageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PageStoreRequest $request): RedirectResponse
    {
        /** @var \App\Models\Pages\Page $page */
        $page = Page::create($request->validated());
        $page->saveSeoMetaFromRequest($request);
        pages(true);

        return redirect()->route('pages.index')->with('toast_success', __('crud.orphan.created', [
            'entity' => __('Free pages'),
            'name' => $page->nav_title,
        ]));
    }

    public function edit(Page $page): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Free pages'),
            'detail' => $page->nav_title,
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
    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        $page->update(Arr::except($request->validated(), 'unique_key'));
        $page->saveSeoMetaFromRequest($request);
        pages(true);

        return redirect()->route('page.edit', $page)->with('toast_success', __('crud.orphan.updated', [
            'entity' => __('Free pages'),
            'name' => $page->nav_title,
        ]));
    }

    /**
     * @param \App\Models\Pages\Page $page
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        pages(true);

        return back()->with('toast_success', __('crud.orphan.destroyed', [
            'entity' => __('Free pages'),
            'name' => $page->nav_title,
        ]));
    }
}
