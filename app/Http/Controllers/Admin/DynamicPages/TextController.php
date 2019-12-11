<?php

namespace App\Http\Controllers\Admin\DynamicPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageBlocks\TextStoreRequest;
use App\Http\Requests\DynamicPageBlocks\TextUpdateRequest;
use App\Models\DynamicPage;
use App\Models\DynamicPageBlock;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TextController extends Controller
{
    /**
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DynamicPage $dynamicPage)
    {
        $dynamicPageBlock = null;

        return view('templates.admin.dynamic-pages.blocks.text', compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @param \App\Http\Requests\DynamicPageBlocks\TextStoreRequest $request
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(TextStoreRequest $request, DynamicPage $dynamicPage)
    {
        $blockConfig = config('dynamic-pages.blocks.text');
        $blockModel = data_get($blockConfig, 'model');

        if (!$blockModel) {
            throw new RuntimeException('Model of \'text\' does not exists');
        }

        $block = new DynamicPageBlock([
            'position'        => -1,
            'block_id'        => 'text',
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

        return redirect()->route('dynamicPage.edit', $dynamicPage);
    }

    /**
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('dynamic-pages.entities.dynamicPageBlocks'),
            'detail' => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
        ]));

        return view('templates.admin.dynamic-pages.blocks.text', compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @param \App\Http\Requests\DynamicPageBlocks\TextUpdateRequest $request
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TextUpdateRequest $request, DynamicPage $dynamicPage, DynamicPageBlock $dynamicPageBlock)
    {
        $dynamicPageBlock->blockable()->update($request->validated());

        return redirect()
            ->route('dynamicPage.edit', $dynamicPage)
            ->with('toast_success', __('notifications.message.crud.orphan.updated', [
                'entity' => __('dynamic-pages.entities.dynamicPages'),
                'name'   => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
            ]));
    }
}
