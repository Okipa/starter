<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\CategoryStoreRequest;
use App\Http\Requests\LibraryMedia\CategoryUpdateRequest;
use App\Models\LibraryMediaCategory;
use App\Services\LibraryMedia\CategoriesService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LibraryMediaCategoriesController extends Controller
{
    /**
     * @return Factory|View
     * @throws Exception
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
     * @return Factory|View
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
     * @param CategoryStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = (new LibraryMediaCategory)->create($request->validated());

        return redirect()->route('libraryMedia.categories.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('Media library'),
                'entity' => __('Categories'),
                'name'   => $category->name,
            ]));
    }

    /**
     * @param LibraryMediaCategory $category
     *
     * @return Factory|View
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
     * @param LibraryMediaCategory $category
     * @param CategoryUpdateRequest $request
     *
     * @return RedirectResponse
     */
    public function update(LibraryMediaCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name'   => $category->name,
        ]));
    }

    /**
     * @param LibraryMediaCategory $category
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(LibraryMediaCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name'   => $name,
        ]));
    }
}
