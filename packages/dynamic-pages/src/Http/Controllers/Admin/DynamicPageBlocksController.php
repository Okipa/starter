<?php

namespace DynamicPages\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DynamicPages\Http\Requests\DynamicPageBlocks\DynamicPageBlockStoreRequest;
use DynamicPages\Models\DynamicPage;
use DynamicPages\Models\DynamicPageBlock;

class DynamicPageBlocksController extends Controller
{
    /**
     * @param \DynamicPages\Http\Requests\DynamicPageBlocks\DynamicPageBlockStoreRequest $request
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DynamicPageBlockStoreRequest $request, DynamicPage $dynamicPage)
    {
        $blockId = $request->get('block_id');
        $blockConfig = config("dynamic-pages.blocks.{$blockId}", []);
        $blockController = $blockConfig['controller'];

        return redirect()
            ->action("\\{$blockController}@create", compact('dynamicPage', 'blockId'));
    }

    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     * @param \DynamicPages\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        $blockConfig = config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []);
        $blockController = $blockConfig['controller'];

        return redirect()
            ->action("\\{$blockController}@edit", compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     * @param \DynamicPages\Models\DynamicPageBlock $dynamicPageBlock
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
                'entity' => __('dynamic-pages::entities.dynamicPageBlocks'),
                'name'   => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
            ]));
    }
}
