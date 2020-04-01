<?php

namespace App\Services\Pages;

use App\Models\Pages\Page;
use Okipa\LaravelTable\Table;

class PagesService
{
    /**
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(Page::class)->routes([
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
        $table->column('slug')->sortable()->searchable();
        $table->column('url')->title(__('Display'))->html(fn(Page $page) => view('components.admin.table.display', [
            'url' => route('page.show', $page->url),
            'active' => $page->active,
        ]));
        $table->column('active')->sortable()->html(fn(Page $page) => view('components.admin.table.active', [
            'active' => $page->active,
        ]));
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();

        return $table;
    }
}
