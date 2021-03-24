<?php

namespace App\Tables;

use App\Models\Cookies\CookieCategory;
use Illuminate\Database\Eloquent\Builder;
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
            ->identifier('cookie-categories-table')
            ->routes([
                'index' => ['name' => 'cookie.categories.index'],
                'create' => ['name' => 'cookie.category.create'],
                'edit' => ['name' => 'cookie.category.edit'],
                'destroy' => ['name' => 'cookie.category.destroy'],
            ])
            ->query(fn(Builder $query) => $query->ordered())
            ->destroyConfirmationHtmlAttributes(fn(CookieCategory $cookieCategory) => [
                'data-confirm' => __('crud.parent.destroy_confirm', [
                    'parent' => __('Cookies'),
                    'entity' => __('Categories'),
                    'name' => $cookieCategory->title,
                ]),
            ])
            ->rowsNumber(null)
            ->activateRowsNumberDefinition(false);
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
        $table->column('id');
        $table->column('unique_key');
        $table->column('title');
        $table->column()
            ->title(__('Associated services'))
            ->link(fn(CookieCategory $cookieCategory) => route(
                'cookie.services.index',
                ['category_id' => $cookieCategory->id]
            ))
            ->value(function (CookieCategory $cookieCategory) {
                $count = $cookieCategory->services->count();

                return trans_choice('[0,1]:count service|[2,*]:count services', $count, compact('count'));
            });
        $table->column('position')->html(fn(CookieCategory $cookieCategory) => '<span class="d-none id">'
            . $cookieCategory->id . '</span>'
            . '<span class="position">' . $cookieCategory->position . '</span>');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i');
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i');
    }
}
