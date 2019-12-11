<?php

namespace DynamicPages\Http\Controllers\Admin\DynamicPages;

use App\Http\Controllers\Controller;
use DynamicPages\Http\Requests\DynamicPageBlocks\TwoColumnsTextStoreRequest;
use DynamicPages\Http\Requests\DynamicPageBlocks\TwoColumnsTextUpdateRequest;
use DynamicPages\Models\DynamicPage;
use DynamicPages\Models\DynamicPageBlock;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TwoColumnsTextController extends Controller
{
    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DynamicPage $dynamicPage)
    {
        $dynamicPageBlock = null;

        return view(
            'dynamic-pages::templates.admin.dynamic-pages.blocks.two_columns_text',
            compact('dynamicPage', 'dynamicPageBlock')
        );
    }

    /**
     * @param \DynamicPages\Http\Requests\DynamicPageBlocks\TwoColumnsTextStoreRequest $request
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(TwoColumnsTextStoreRequest $request, DynamicPage $dynamicPage)
    {
        $blockConfig = config('dynamic-pages.blocks.two_columns_text');
        $blockModel = data_get($blockConfig, 'model');

        if (!$blockModel) {
            throw new RuntimeException('Model of \'two_columns_text\' does not exists');
        }

        $block = new DynamicPageBlock([
            'position'        => -1,
            'block_id'        => 'two_columns_text',
            'dynamic_page_id' => data_get($dynamicPage, 'id'),
        ]);

        DB::transaction(function () use ($blockModel, $request, $block) {
            /** @var \App\Models\DynamicPages\Blockable $blockable */
            $blockable = app($blockModel)->create($request->validated());

            if (!$blockable) {
                throw new RuntimeException('Unable to create blockable');
            }

            if (!$blockable->block()->save($block)) {
                throw new RuntimeException('Unable to create block');
            }
        });

        return redirect()->route('dynamic-pages::dynamicPage.edit', $dynamicPage);
    }

    /**
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     * @param \DynamicPages\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('dynamic-pages::entities.dynamicPageBlocks'),
            'detail' => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
        ]));

        return view(
            'dynamic-pages::templates.admin.dynamic-pages.blocks.two_columns_text',
            compact('dynamicPage', 'dynamicPageBlock')
        );
    }

    /**
     * @param \DynamicPages\Http\Requests\DynamicPageBlocks\TwoColumnsTextUpdateRequest $request
     * @param \DynamicPages\Models\DynamicPage $dynamicPage
     * @param \DynamicPages\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        TwoColumnsTextUpdateRequest $request,
        DynamicPage $dynamicPage,
        DynamicPageBlock $dynamicPageBlock
    ) {
        $dynamicPageBlock->blockable()->update($request->validated());

        return redirect()
            ->route('dynamic-pages::dynamicPage.edit', $dynamicPage)
            ->with('toast_success', __('notifications.message.crud.orphan.updated', [
                'entity' => __('dynamic-pages::entities.dynamicPages'),
                'name'   => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
            ]));
    }
}
