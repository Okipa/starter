<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookies\CookieCategoryStoreRequest;
use App\Http\Requests\Cookies\CookieCategoryUpdateRequest;
use App\Models\Cookies\CookieCategory;
use App\Tables\CookieCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CookieCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = app(CookieCategoriesTable::class)->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.cookies.categories.index', compact('table'));
    }

    public function create(): View
    {
        $cookieCategory = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.cookies.categories.edit', compact('cookieCategory'));
    }

    public function store(CookieCategoryStoreRequest $request): RedirectResponse
    {
        $cookieCategory = CookieCategory::create($request->validated());

        return redirect()->route('cookie.categories.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('Cookies'),
                'entity' => __('Categories'),
                'name' => $cookieCategory->name,
            ]));
    }

    public function edit(CookieCategory $cookieCategory): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'detail' => $cookieCategory->name,
        ]));

        return view('templates.admin.cookies.categories.edit', compact('cookieCategory'));
    }

    public function update(CookieCategoryUpdateRequest $request, CookieCategory $cookieCategory): RedirectResponse
    {
        $cookieCategory->update($request->validated());

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'name' => $cookieCategory->name,
        ]));
    }

    public function destroy(CookieCategory $cookieCategory): RedirectResponse
    {
        $cookieCategory->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'name' => $cookieCategory->title,
        ]));
    }
}
