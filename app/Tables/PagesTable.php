<?php

namespace App\Tables;

use App\Models\Pages\Page;
use Illuminate\Support\Facades\Lang;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class PagesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table)->model(Page::class)->routes([
            'index' => ['name' => 'pages.index'],
            'create' => ['name' => 'page.create'],
            'edit' => ['name' => 'page.edit'],
            'destroy' => ['name' => 'page.destroy'],
        ])->destroyConfirmationHtmlAttributes(fn(Page $page) => [
            'data-confirm' => __('notifications.orphan.destroyConfirm', [
                'entity' => __('Pages'),
                'name' => $page->slug,
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
        $table->column('unique_key')->sortable()->searchable();
        $table->column('slug')
            ->value(fn(Page $page) => '/' . (Lang::has('routes.page') ? __('routes.page') : 'page') . '/' . $page->slug)
            ->sortable()
            ->searchable();
        $table->column()->title(__('Display'))->html(fn(Page $page) => view('components.admin.table.display', [
            'url' => route('page.show', $page->slug),
            'active' => $page->active,
        ]));
        $table->column('active')->sortable()->html(fn(Page $page) => view('components.admin.table.active', [
            'active' => $page->active,
        ]));
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
    }
}
