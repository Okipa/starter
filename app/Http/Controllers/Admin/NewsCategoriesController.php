<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CategoryStoreRequest;
use App\Http\Requests\News\CategoryUpdateRequest;
use App\Models\News\NewsCategory;
use App\Services\News\CategoriesService;
use Artesaos\SEOTools\Facades\SEOTools;

class NewsCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $table = (new CategoriesService)->table();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    /**
     * @param \App\Http\Requests\News\CategoryStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = (new NewsCategory)->create($request->validated());

        return redirect()->route('news.categories.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('News'),
                'entity' => __('Categories'),
                'name' => $category->name,
            ]));
    }

    /**
     * @param \App\Models\News\NewsCategory $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(NewsCategory $category)
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'detail' => $category->name,
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    /**
     * @param \App\Models\News\NewsCategory $category
     * @param \App\Http\Requests\News\CategoryUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }

    /**
     * @param \App\Models\News\NewsCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $name,
        ]));
    }
}
