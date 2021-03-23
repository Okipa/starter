<?php

namespace App\Tables;

use App\Models\Cookies\CookieCategory;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class CookieCategoriesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(CookieCategory::class)
            ->routes([
                'index' => ['name' => 'cookie.categories.index'],
                'create' => ['name' => 'cookie.category.create'],
                'edit' => ['name' => 'cookie.category.edit'],
                'destroy' => ['name' => 'cookie.category.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(CookieCategory $cookieCategory) => [
                'data-confirm' => __('crud.parent.destroy_confirm', [
                    'parent' => __('Cookies'),
                    'entity' => __('Categories'),
                    'name' => $cookieCategory->title,
                ]),
            ]);
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
        $table->column('title')->sortable()->searchable();
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
