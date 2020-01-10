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
use Okipa\LaravelBrickables\Brickables\OneTextColumn;

class SimplePagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $table = (new SimpleSimplePagesService)->table();
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Simple pages')]));

        return view('templates.admin.simple-pages.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $simplePage = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Users')]));

        return view('templates.admin.simple-pages.edit', compact('simplePage'));
    }

    /**
     * @param \App\Http\Requests\SimplePages\SimplePageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(SimplePageStoreRequest $request)
    {
        $simplePage = (new SimplePage)->create($request->validated());
        (new SeoService)->saveSeoTagsFromRequest($simplePage, $request);
        simplePages(true);

        return redirect()->route('simplePages.index')->with('toast_success', __('notifications.orphan.created', [
            'entity' => __('Simple pages'),
            'name' => $simplePage->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SimplePage $simplePage)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Simple pages'),
            'detail' => $simplePage->title,
        ]));

         //$simplePage->addBrick(OneTextColumn::class, ['content' => 'Text']);

        return view('templates.admin.simple-pages.edit', compact('simplePage'));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     * @param \App\Http\Requests\SimplePages\SimplePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(SimplePage $simplePage, SimplePageUpdateRequest $request)
    {
        $simplePage->update(Arr::except($request->validated(), 'slug'));
        (new SeoService)->saveSeoTagsFromRequest($simplePage, $request);
        simplePages(true);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Simple pages'),
            'name' => $simplePage->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SimplePage $simplePage)
    {
        $name = $simplePage->title;
        $simplePage->delete();
        simplePages(true);

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Simple pages'),
            'name' => $name,
        ]));
    }
}
