<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SimplePages\SimplePageStoreRequest;
use App\Http\Requests\SimplePages\SimplePageUpdateRequest;
use App\Models\SimplePage;
use App\Services\Seo\SeoService;
use App\Services\SimplePages\SimpleSimplePagesService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SimplePagesController extends Controller
{
    /**
     * @return Factory|View
     * @throws Exception
     */
    public function index()
    {
        $table = (new SimpleSimplePagesService)->table();
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('entities.simplePages')]));

        return view('templates.admin.simple-pages.index', compact('table'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $simplePage = null;
        SEOTools::setTitle(__('admin.title.orphan.create', ['entity' => __('entities.users')]));

        return view('templates.admin.simple-pages.edit', compact('simplePage'));
    }

    /**
     * @param SimplePageStoreRequest $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(SimplePageStoreRequest $request)
    {
        $simplePage = (new SimplePage)->create($request->validated());
        (new SeoService)->saveSeoTagsFromRequest($simplePage, $request);
        cache()->forever(Str::camel($simplePage->slug), $simplePage->fresh());

        return redirect()->route('simplePages')->with('toast_success', __('notifications.message.crud.orphan.created', [
            'entity' => __('entities.simplePages'),
            'name' => $simplePage->title,
        ]));
    }

    /**
     * @param SimplePage $simplePage
     *
     * @return Factory|View
     */
    public function edit(SimplePage $simplePage)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('entities.simplePages'),
            'detail' => $simplePage->title,
        ]));

        return view('templates.admin.simple-pages.edit', compact('simplePage'));
    }

    /**
     * @param SimplePage $simplePage
     * @param SimplePageUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(SimplePage $simplePage, SimplePageUpdateRequest $request)
    {
        cache()->forget(Str::camel($simplePage->slug));
        $simplePage->update(Arr::except($request->validated(), 'slug'));
        (new SeoService)->saveSeoTagsFromRequest($simplePage, $request);
        cache()->forever(Str::camel($simplePage->slug), $simplePage->fresh());

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.simplePages'),
            'name' => $simplePage->title,
        ]));
    }

    /**
     * @param SimplePage $simplePage
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(SimplePage $simplePage)
    {
        $name = $simplePage->title;
        cache()->forget(Str::camel($simplePage->slug));
        $simplePage->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.simplePages'),
            'name' => $name,
        ]));
    }
}
