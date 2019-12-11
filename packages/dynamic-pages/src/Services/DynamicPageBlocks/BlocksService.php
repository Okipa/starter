<?php

namespace DynamicPages\Services\DynamicPageBlocks;

use DynamicPages\Models\DynamicPage;
use DynamicPages\Models\DynamicPageBlock;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Table;

class BlocksService extends Service implements BlocksServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(DynamicPage $dynamicPage): Table
    {
        $table = (new Table)
            ->model(DynamicPageBlock::class)
            ->routes([
                'index'   => ['name' => 'dynamic-pages::dynamicPageBlocks', 'params' => [ 'dynamicPage' => $dynamicPage ]],
                'edit'    => ['name' => 'dynamic-pages::dynamicPageBlock.edit', 'params' => [ 'dynamicPage' => $dynamicPage ]],
                'destroy' => ['name' => 'dynamic-pages::dynamicPageBlock.destroy', 'params' => [ 'dynamicPage' => $dynamicPage ]],
            ])
            ->query(function (Builder $query) use ($dynamicPage) {
                return $query->where('dynamic_page_id', $dynamicPage->id);
            })
            ->destroyConfirmationHtmlAttributes(function (DynamicPageBlock $dynamicPageBlock) {
                return [
                    'data-confirm' => __('notifications.message.crud.orphan.destroyConfirm', [
                        'entity' => __('dynamic-pages::entities.dynamicPages'),
                        'name'   => $dynamicPageBlock->name,
                    ]),
                ];
            })
            ->tableClasses([ 'mb-0' ])
            ->rowsNumberSelectionActivation(false);

        $table
            ->column('block_id')
            ->title(__('dynamic-pages::validation.attributes.block_id'))
            ->value(function (DynamicPageBlock $dynamicPageBlock) {
                return __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name'));
            });

        return $table;
    }
}
