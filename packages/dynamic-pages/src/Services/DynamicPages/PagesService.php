<?php

namespace DynamicPages\Services\DynamicPages;

use DynamicPages\Models\DynamicPage;
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
        $table = (new Table)->model(DynamicPage::class)->routes([
            'index'   => ['name' => 'dynamic-pages::dynamicPages'],
            'create'  => ['name' => 'dynamic-pages::dynamicPage.create'],
            'edit'    => ['name' => 'dynamic-pages::dynamicPage.edit'],
            'destroy' => ['name' => 'dynamic-pages::dynamicPage.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (DynamicPage $dynamicPage) {
            return [
                'data-confirm' => __('notifications.message.crud.orphan.destroyConfirm', [
                    'entity' => __('dynamic-pages::entities.dynamicPages'),
                    'name'   => $dynamicPage->title,
                ]),
            ];
        });
        $table->column('title')
            ->sortable(true)
            ->searchable();
        $table->column('slug')
            ->sortable()
            ->searchable();
        $table->column('url')->title(__('components.table.link'))->html(function (DynamicPage $dynamicPage) {
            return view('components.admin.table.link', [
                'url'    => route('dynamic-pages::dynamicPage.show', $dynamicPage->url),
                'active' => $dynamicPage->active,
            ]);
        });
        $table->column('active')
            ->sortable()
            ->html(function (DynamicPage $dynamicPage) {
                return view('components.admin.table.active', [
                    'active' => $dynamicPage->active,
                ]);
            });

        return $table;
    }
}
