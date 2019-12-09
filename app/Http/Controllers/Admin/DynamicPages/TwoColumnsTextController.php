<?php

namespace App\Http\Controllers\Admin\DynamicPages;

use App\Http\Controllers\Controller;
use App\Models\DynamicPages\TwoColumnsText;

class TwoColumnsTextController extends Controller
{

    public function edit(TwoColumnsText $blockable)
    {
        return view('dynamic-pages.blockable.two-columns-text', compact('blockable'));
    }
}
