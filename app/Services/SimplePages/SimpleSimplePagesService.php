<?php

namespace App\Services\SimplePages;

use App\Models\SimplePage;
use App\Services\Service;
use ErrorException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Okipa\LaravelTable\Table;

class SimpleSimplePagesService extends Service implements SimplePagesServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return Table
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(SimplePage::class)->routes([
            'index' => ['name' => 'simplePages.index'],
            'create' => ['name' => 'simplePage.create'],
            'edit' => ['name' => 'simplePage.edit'],
            'destroy' => ['name' => 'simplePage.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (SimplePage $simplePage) {
            return [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Simple pages'),
                    'name' => $simplePage->title,
                ]),
            ];
        });
        $table->column('title')
            ->sortable(true)
            ->searchable();
        $table->column('slug')
            ->sortable()
            ->searchable();
        $table->column('url')->title(__('components.table.link'))->html(function (SimplePage $simplePage) {
            return view('components.admin.table.link', [
                'url' => route('simplePage.show', $simplePage->url),
                'active' => $simplePage->active,
            ]);
        });
        $table->column('active')
            ->sortable()
            ->html(function (SimplePage $simplePage) {
                return view('components.admin.table.active', [
                    'active' => $simplePage->active,
                ]);
            });

        return $table;
    }
}
