<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\CategoryStoreRequest;
use App\Http\Requests\LibraryMedia\CategoryUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Services\LibraryMedia\CategoriesService;
use Artesaos\SEOTools\Facades\SEOTools;

class LibraryMediaCategoriesController extends Controller
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
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\CategoryStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        /** @var \App\Models\LibraryMedia\LibraryMediaCategory $category */
        $category = (new LibraryMediaCategory)->create($request->validated());

        return redirect()->route('libraryMedia.categories.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('Media library'),
                'entity' => __('Categories'),
                'name' => $category->name,
            ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaCategory $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LibraryMediaCategory $category)
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'detail' => $category->name,
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaCategory $category
     * @param \App\Http\Requests\LibraryMedia\CategoryUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LibraryMediaCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LibraryMediaCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $name,
        ]));
    }
}
