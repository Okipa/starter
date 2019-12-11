<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;
use App\Http\Controllers\Controller;
use App\Services\News\CategoriesService;
use App\Http\Requests\News\CategoryStoreRequest;
use App\Http\Requests\News\CategoryUpdateRequest;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsCategoriesController extends Controller
{
    /**
     * @return Factory|View
     * @throws Exception
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
     * @return Factory|View
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
     * @param CategoryStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = (new NewsCategory)->create($request->validated());

        return redirect()->route('news.categories.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('News'),
                'entity' => __('Categories'),
                'name'   => $category->name,
            ]));
    }

    /**
     * @param NewsCategory $category
     *
     * @return Factory|View
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
     * @param NewsCategory $category
     * @param CategoryUpdateRequest $request
     *
     * @return RedirectResponse
     */
    public function update(NewsCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name'   => $category->name,
        ]));
    }

    /**
     * @param NewsCategory $category
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(NewsCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name'   => $name,
        ]));
    }
}
