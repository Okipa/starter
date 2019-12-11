<?php

namespace App\Services\LibraryMedia;

use App\Models\LibraryMediaCategory;
use App\Services\Service;
use Okipa\LaravelTable\Table;

class CategoriesService extends Service implements CategoriesServiceInterface
{
    /**
     * Configure the model table list.
     *
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

        return $table;
    }
}
