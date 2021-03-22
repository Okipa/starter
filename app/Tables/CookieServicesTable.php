<?php

namespace App\Tables;

use App\Models\Cookies\CookieService;
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
                'index'   => ['name' => 'cookie.services.index'],
                'create'  => ['name' => 'cookie.service.create'],
                'edit'    => ['name' => 'cookie.service.edit'],
                'destroy' => ['name' => 'cookie.service.destroy'],
            ])
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
        $table->column('id')->sortable();
        $table->column('title')->sortable()->searchable();
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
