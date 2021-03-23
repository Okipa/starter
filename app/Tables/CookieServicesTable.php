<?php

namespace App\Tables;

use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class CookieServicesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(CookieService::class)
            ->routes([
                'index' => ['name' => 'cookie.services.index'],
                'create' => ['name' => 'cookie.service.create'],
                'edit' => ['name' => 'cookie.service.edit'],
                'destroy' => ['name' => 'cookie.service.destroy'],
            ])
            ->query(fn(Builder $query) => $query->ordered())
            ->destroyConfirmationHtmlAttributes(fn(CookieService $cookieService) => [
                'data-confirm' => __('crud.parent.destroy_confirm', [
                    'parent' => __('Cookies'),
                    'entity' => __('Services'),
                    'name' => $cookieService->title,
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
        $table->column('id');
        $table->column('unique_key');
        $table->column('title');
        $table->column()
            ->title(__('Categories'))
            ->value(fn(CookieService $cookieService) => $cookieService->categories
                ->map(function (CookieCategory $cookieCategory) {
                    $cookieCategory->title = Str::limit($cookieCategory->title, 25);

                    return $cookieCategory;
                })
                ->implode('title', ', '));
        $table->column('position')->html(fn(CookieService $cookieService) => '<span class="d-none id">'
            . $cookieService->id . '</span>'
            . '<span class="position">' . $cookieService->position . '</span>');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i');
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i');
    }
}
