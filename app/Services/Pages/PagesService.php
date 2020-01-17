<?php

namespace App\Services\Pages;

use App\Models\Pages\Page;
use App\Services\Service;
use Okipa\LaravelTable\Table;

class PagesService extends Service implements PagesServiceInterface
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
        $table = (new Table)->model(Page::class)->routes([
            'index' => ['name' => 'pages.index'],
            'create' => ['name' => 'page.create'],
            'edit' => ['name' => 'page.edit'],
            'destroy' => ['name' => 'page.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (Page $page) {
            return [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Pages'),
                    'name' => $page->title,
                ]),
            ];
        });
        $table->column('title')
            ->sortable(true)
            ->searchable();
        $table->column('slug')
            ->sortable()
            ->searchable();
        $table->column('url')->title(__('Link'))->html(function (Page $page) {
            return view('components.admin.table.link', [
                'url' => route('page.show', $page->url),
                'active' => $page->active,
            ]);
        });
        $table->column('active')
            ->sortable()
            ->html(function (Page $page) {
                return view('components.admin.table.active', [
                    'active' => $page->active,
                ]);
            });

        return $table;
    }
}
