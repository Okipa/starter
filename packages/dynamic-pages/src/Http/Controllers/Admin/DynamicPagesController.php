<?php

namespace DynamicPages\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use DynamicPages\Http\Requests\DynamicPages\DynamicPageStoreRequest;
use DynamicPages\Http\Requests\DynamicPages\DynamicPageUpdateRequest;
use DynamicPages\Models\DynamicPage;
use DynamicPages\Services\DynamicPages\PagesService;
use Illuminate\Support\Str;

class DynamicPagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new PagesService)->table();
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('dynamic-pages::entities.dynamicPages')]));

        return view('dynamic-pages::templates.admin.dynamic-pages.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $dynamicPage = null;
        SEOTools::setTitle(__('admin.title.orphan.create', ['entity' => __('dynamic-pages::entities.dynamicPages')]));

        return view('dynamic-pages::templates.admin.dynamic-pages.edit', compact('dynamicPage'));
    }

    /**
     * @param \DynamicPages\Http\Requests\DynamicPages\DynamicPageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(DynamicPageStoreRequest $request)
    {
        $dynamicPage = (new DynamicPage)->create($request->validated());
        (new SeoService)->saveMetaTagsFromRequest($dynamicPage, $request);
        cache()->forever(Str::camel($dynamicPage->slug), $dynamicPage->fresh());

        return redirect()
            ->route('dynamic-pages::dynamicPages')
            ->with('toast_success', __('notifications.message.crud.orphan.created', [
                'entity' => __('dynamic-pages::entities.dynamicPages'),
                'name'   => $dynamicPage->title,
            ]));
    }

    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(DynamicPage $dynamicPage)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('dynamic-pages::entities.dynamicPages'),
            'detail' => $dynamicPage->title,
        ]));

        return view('dynamic-pages::templates.admin.dynamic-pages.edit', compact('dynamicPage'));
    }

    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     * @param \DynamicPages\Http\Requests\DynamicPages\DynamicPageUpdateRequest $request
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
            'entity' => __('dynamic-pages::entities.dynamicPages'),
            'name'   => $dynamicPage->title,
        ]));
    }

    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
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
            'entity' => __('dynamic-pages::entities.dynamicPages'),
            'name'   => $name,
        ]));
    }
}
