<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\CategoryStoreRequest;
use App\Http\Requests\LibraryMedia\CategoryUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Services\LibraryMedia\CategoriesService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LibraryMediaCategoriesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        $table = (new CategoriesService)->table();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.index', compact('table'));
    }

    public function create(): View
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
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

    public function edit(LibraryMediaCategory $category): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'detail' => $category->name,
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    public function update(LibraryMediaCategory $category, CategoryUpdateRequest $request): RedirectResponse
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }

    public function destroy(LibraryMediaCategory $category): RedirectResponse
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
