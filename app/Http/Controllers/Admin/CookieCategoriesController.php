<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookies\CookieCategoriesReorderRequest;
use App\Http\Requests\Cookies\CookieCategoryStoreRequest;
use App\Http\Requests\Cookies\CookieCategoryUpdateRequest;
use App\Models\Cookies\CookieCategory;
use App\Tables\CookieCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param \App\Http\Requests\Cookies\CookieCategoryStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CookieCategoryStoreRequest $request): RedirectResponse
    {
        $cookieCategory = CookieCategory::create($request->validated());
        cookieCategories(true);

        return redirect()->route('cookie.categories.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('Cookies'),
                'entity' => __('Categories'),
                'name' => $cookieCategory->title,
            ]));
    }

    public function edit(CookieCategory $cookieCategory): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'detail' => $cookieCategory->title,
        ]));

        return view('templates.admin.cookies.categories.edit', compact('cookieCategory'));
    }

    /**
     * @param \App\Http\Requests\Cookies\CookieCategoryUpdateRequest $request
     * @param \App\Models\Cookies\CookieCategory $cookieCategory
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CookieCategoryUpdateRequest $request, CookieCategory $cookieCategory): RedirectResponse
    {
        $cookieCategory->update($request->validated());
        cookieCategories(true);

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'name' => $cookieCategory->title,
        ]));
    }

    /**
     * @param \App\Models\Cookies\CookieCategory $cookieCategory
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CookieCategory $cookieCategory): RedirectResponse
    {
        $cookieCategory->delete();
        cookieCategories(true);

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Cookies'),
            'entity' => __('Categories'),
            'name' => $cookieCategory->title,
        ]));
    }

    /**
     * @param \App\Http\Requests\Cookies\CookieCategoriesReorderRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function reorder(CookieCategoriesReorderRequest $request): JsonResponse
    {
        CookieCategory::setNewOrder($request->validated()['ordered_ids']);
        cookieCategories(true);

        return response()->json(['message' => __('The list has been reordered.')]);
    }
}
