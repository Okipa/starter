<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageBlocks\DynamicPageBlockStoreRequest;
use App\Models\DynamicPage;
use App\Models\DynamicPageBlock;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DynamicPageBlocksController extends Controller
{

    public function store(DynamicPageBlockStoreRequest $request, DynamicPage $dynamicPage)
    {
        $blockId = $request->get('block_id');
        $blockConfig = config("dynamic-pages.blocks.{$blockId}", []);
        $blockModel = data_get($blockConfig, 'model', false);

        if (!$blockConfig) {
            throw new RuntimeException("Block '{$blockId}' does not exists");
        }

        if (!$blockModel) {
            throw new RuntimeException("Model of '{$blockId}' is not defined");
        }

        $block = new DynamicPageBlock([
            'position'        => -1,
            'block_id'        => $blockId,
            'dynamic_page_id' => $dynamicPage->id,
        ]);

        DB::transaction(function () use ($blockModel, $block) {
            $blockable = app($blockModel)->create();

            if (!$blockable) {
                throw new RuntimeException('Unable to create blockable');
            }

            if (!$blockable->block()->save($block)) {
                throw new RuntimeException('Unable to create block');
            }
        });

        return back();
    }
}
