<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;
use App\Http\Controllers\Controller;
use App\Services\News\CategoriesService;
use App\Http\Requests\News\CategoryStoreRequest;
use App\Http\Requests\News\CategoryUpdateRequest;
use Artesaos\SEOTools\Facades\SEOTools;

class NewsCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new CategoriesService)->table();
        SEOTools::setTitle(__('admin.title.parent.index', [
            'parent' => __('entities.news'),
            'entity' => __('entities.categories'),
        ]));

        return view('templates.admin.news.categories.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = null;
        SEOTools::setTitle(__('admin.title.parent.create', [
            'parent' => __('entities.news'),
            'entity' => __('entities.categories'),
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

        return redirect()->route('news.categories')
            ->with('toast_success', __('notifications.message.crud.parent.created', [
                'parent' => __('entities.news'),
                'entity' => __('entities.categories'),
                'name'   => $category->title,
            ]));
    }

    /**
     * @param \App\Models\NewsCategory $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(NewsCategory $category)
    {
        SEOTools::setTitle(__('admin.title.parent.edit', [
            'parent' => __('entities.news'),
            'entity' => __('entities.categories'),
            'detail' => $category->title,
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    /**
     * @param \App\Models\NewsCategory $category
     * @param \App\Http\Requests\News\CategoryUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.message.crud.parent.updated', [
            'parent' => __('entities.news'),
            'entity' => __('entities.categories'),
            'name'   => $category->title,
        ]));
    }

    /**
     * @param \App\Models\NewsCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsCategory $category)
    {
        $name = $category->title;
        $category->delete();

        return back()->with('toast_success', __('notifications.message.crud.parent.destroyed', [
            'parent' => __('entities.news'),
            'entity' => __('entities.categories'),
            'name'   => $name,
        ]));
    }
}
