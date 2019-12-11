<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageBlocks\DynamicPageBlockStoreRequest;
use App\Models\DynamicPage;
use App\Models\DynamicPageBlock;

class DynamicPageBlocksController extends Controller
{
    /**
     * @param \App\Http\Requests\DynamicPageBlocks\DynamicPageBlockStoreRequest $request
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DynamicPageBlockStoreRequest $request, DynamicPage $dynamicPage)
    {

        $blockId = $request->get('block_id');
        $blockConfig = config("dynamic-pages.blocks.{$blockId}", []);
        $blockController = array_reverse(explode('\\', $blockConfig['controller']))[0];

        return redirect()
            ->action("Admin\\DynamicPages\\{$blockController}@create", compact('dynamicPage', 'blockId'));
    }

    /**
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        $blockConfig = config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []);
        $blockController = array_reverse(explode('\\', data_get($blockConfig, 'controller')))[0];

        return redirect()
            ->action("Admin\\DynamicPages\\{$blockController}@edit", compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        $dynamicPageBlock->blockable()->delete();
        $dynamicPageBlock->delete();

        return back()
            ->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
                'entity' => __('dynamic-pages.entities.dynamicPageBlocks'),
                'name'   => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
            ]));
    }
}
