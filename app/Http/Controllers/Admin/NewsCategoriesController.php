<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CategoryStoreRequest;
use App\Http\Requests\News\CategoryUpdateRequest;
use App\Models\News\NewsCategory;
use App\Services\News\CategoriesService;
use App\Tables\NewsCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsCategoriesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = (new NewsCategoriesTable)->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.index', compact('table'));
    }

    public function create(): View
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $category = (new NewsCategory)->create($request->validated());

        return redirect()->route('news.categories.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('News'),
                'entity' => __('Categories'),
                'name' => $category->name,
            ]));
    }

    public function edit(NewsCategory $category): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'detail' => $category->name,
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    public function update(NewsCategory $category, CategoryUpdateRequest $request): RedirectResponse
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }

    public function destroy(NewsCategory $category): RedirectResponse
    {
        $category->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }
}
