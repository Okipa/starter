<?php

namespace App\Http\Controllers\Admin;

use App\Models\DynamicPage;
use App\Http\Controllers\Controller;
use App\Services\Seo\SeoService;
use App\Services\DynamicPages\PagesService;
use App\Http\Requests\DynamicPages\DynamicPageStoreRequest;
use App\Http\Requests\DynamicPages\DynamicPageUpdateRequest;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOTools;

class DynamicPagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new PagesService)->table();
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('dynamic-pages.entities.dynamicPages')]));

        return view('templates.admin.dynamic-pages.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $dynamicPage = null;
        SEOTools::setTitle(__('admin.title.orphan.create', ['entity' => __('dynamic-pages.entities.dynamicPages')]));

        return view('templates.admin.dynamic-pages.edit', compact('dynamicPage'));
    }

    /**
     * @param \App\Http\Requests\DynamicPages\DynamicPageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(DynamicPageStoreRequest $request)
    {
        $dynamicPage = (new DynamicPage)->create($request->validated());
        (new SeoService)->saveMetaTagsFromRequest($dynamicPage, $request);
        cache()->forever(Str::camel($dynamicPage->slug), $dynamicPage->fresh());

        return redirect()->route('dynamicPages')->with('toast_success', __('notifications.message.crud.orphan.created', [
            'entity' => __('dynamic-pages.entities.dynamicPages'),
            'name'   => $dynamicPage->title,
        ]));
    }

    /**
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(DynamicPage $dynamicPage)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('dynamic-pages.entities.dynamicPages'),
            'detail' => $dynamicPage->title,
        ]));

        return view('templates.admin.dynamic-pages.edit', compact('dynamicPage'));
    }

    /**
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Http\Requests\DynamicPages\DynamicPageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(DynamicPage $dynamicPage, DynamicPageUpdateRequest $request)
    {
        cache()->forget(Str::camel($dynamicPage->slug));
        $dynamicPage->update($request->except('slug'));
        (new SeoService)->saveMetaTagsFromRequest($dynamicPage, $request);
        cache()->forever(Str::camel($dynamicPage->slug), $dynamicPage->fresh());

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('dynamic-pages.entities.dynamicPages'),
            'name'   => $dynamicPage->title,
        ]));
    }

    /**
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(DynamicPage $dynamicPage)
    {
        $name = $dynamicPage->title;
        cache()->forget(Str::camel($dynamicPage->slug));
        $dynamicPage->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('dynamic-pages.entities.dynamicPages'),
            'name'   => $name,
        ]));
    }
}
