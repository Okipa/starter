<?php

namespace App\Services\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Okipa\LaravelTable\Table;

class CategoriesService
{
    /**
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(LibraryMediaCategory::class)->routes([
            'index' => ['name' => 'libraryMedia.categories.index'],
            'create' => ['name' => 'libraryMedia.category.create'],
            'edit' => ['name' => 'libraryMedia.category.edit'],
            'destroy' => ['name' => 'libraryMedia.category.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (LibraryMediaCategory $libraryMediaCategory) {
            return [
                'data-confirm' => __('notifications.parent.destroyConfirm', [
                    'parent' => __('Media library'),
                    'entity' => __('Categories'),
                    'name' => $libraryMediaCategory->name,
                ]),
            ];
        });
        $table->column('name')->stringLimit(30)->sortable()->searchable();
        $table->column()
            ->title(__('Files count'))
            ->link(fn(LibraryMediaCategory $libraryMediaCategory) => route('libraryMedia.files.index', [
                'category_id' => $libraryMediaCategory->id,
            ]))
            ->button()
            ->value(function (LibraryMediaCategory $libraryMediaCategory) {
                $count = $libraryMediaCategory->files->count();

                return trans_choice('[0,1]:count file|[2,*]:count files', $count, compact('count'));
            });

        return $table;
    }
}
