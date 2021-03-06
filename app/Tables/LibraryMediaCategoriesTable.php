<?php

namespace App\Tables;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class LibraryMediaCategoriesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(LibraryMediaCategory::class)
            ->routes([
                'index' => ['name' => 'libraryMedia.categories.index'],
                'create' => ['name' => 'libraryMedia.category.create'],
                'edit' => ['name' => 'libraryMedia.category.edit'],
                'destroy' => ['name' => 'libraryMedia.category.destroy'],
            ])
            ->query(fn(Builder $query) => $query->with(['files']))
            ->destroyConfirmationHtmlAttributes(function (LibraryMediaCategory $libraryMediaCategory) {
                return [
                    'data-confirm' => __('crud.parent.destroy_confirm', [
                        'parent' => __('Media library'),
                        'entity' => __('Categories'),
                        'name' => $libraryMediaCategory->title,
                    ]),
                ];
            });
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable();
        $table->column('title')->stringLimit(25)->sortable()->searchable();
        $table->column()
            ->title(__('Associated files'))
            ->link(fn(LibraryMediaCategory $libraryMediaCategory) => route('libraryMedia.files.index', [
                'category_id' => $libraryMediaCategory->id,
            ]))
            ->value(function (LibraryMediaCategory $libraryMediaCategory) {
                $count = $libraryMediaCategory->files->count();

                return trans_choice('[0,1]:count file|[2,*]:count files', $count, compact('count'));
            });
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
