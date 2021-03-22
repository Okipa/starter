<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\CookieServiceStoreRequest;
use App\Http\Requests\LibraryMedia\CookieServiceUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Tables\LibraryMediaCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class LibraryMediaCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = app(LibraryMediaCategoriesTable::class)->setup();
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

    public function store(CookieServiceStoreRequest $request): RedirectResponse
    {
        $category = LibraryMediaCategory::create($request->validated());

        return redirect()->route('libraryMedia.categories.index')
            ->with('toast_success', __('crud.parent.created', [
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

    public function update(CookieServiceUpdateRequest $request, LibraryMediaCategory $category): RedirectResponse
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }

    public function destroy(LibraryMediaCategory $category): RedirectResponse
    {
        $category->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->name,
        ]));
    }
}
