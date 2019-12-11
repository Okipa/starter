<?php

namespace App\Http\Controllers\Admin\DynamicPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageBlocks\TextImageStoreRequest;
use App\Http\Requests\DynamicPageBlocks\TextImageUpdateRequest;
use App\Models\DynamicPage;
use App\Models\DynamicPageBlock;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TextImageController extends Controller
{
    /**
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DynamicPage $dynamicPage)
    {
        $dynamicPageBlock = null;

        return view('templates.admin.dynamic-pages.blocks.text_image', compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @param \App\Http\Requests\DynamicPageBlocks\TextImageStoreRequest $request
     * @param \App\Models\DynamicPage $dynamicPage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(TextImageStoreRequest $request, DynamicPage $dynamicPage)
    {
        $blockId = $request->query('blockId', 'text_image');
        $blockConfig = config("dynamic-pages.blocks.{$blockId}");
        $blockModel = data_get($blockConfig, 'model');

        if (!$blockModel) {
            throw new RuntimeException('Model of \'text_image\' does not exists');
        }

        $block = new DynamicPageBlock([
            'position'        => -1,
            'block_id'        => $blockId,
            'dynamic_page_id' => data_get($dynamicPage, 'id'),
        ]);

        DB::transaction(function () use ($blockModel, $request, $block) {
            /** @var \App\Models\DynamicPages\TextImage $blockable */
            $blockable = app($blockModel)->create($request->validated());
            $blockable
                ->addMediaFromRequest('image')
                ->toMediaCollection('text_images');

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

        return view('templates.admin.dynamic-pages.blocks.text_image', compact('dynamicPage', 'dynamicPageBlock'));
    }

    /**
     * @param \App\Http\Requests\DynamicPageBlocks\TextImageUpdateRequest $request
     * @param \App\Models\DynamicPage $dynamicPage
     * @param \App\Models\DynamicPageBlock $dynamicPageBlock
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(
        TextImageUpdateRequest $request,
        DynamicPage $dynamicPage,
        DynamicPageBlock $dynamicPageBlock
    ) {
        /** @var \App\Models\DynamicPages\TextImage $blockable */
        $blockable = $dynamicPageBlock->blockable()->update($request->validated());

        if ($request->file('image')) {
            $blockable
                ->addMediaFromRequest('image')
                ->toMediaCollection('text_images');
        }

        return redirect()
            ->route('dynamicPage.edit', $dynamicPage)
            ->with('toast_success', __('notifications.message.crud.orphan.updated', [
                'entity' => __('dynamic-pages.entities.dynamicPages'),
                'name'   => __(data_get(config("dynamic-pages.blocks.{$dynamicPageBlock->block_id}", []), 'name')),
            ]));
    }
}
