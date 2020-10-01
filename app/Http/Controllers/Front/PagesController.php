<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\Page;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @param \App\Models\Pages\Page $page
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function show(Page $page): View
    {
        if (! $page->active) {
            abort(404);
        }
        $page->displaySeoMeta();

        return view('templates.front.pages.show', compact('page'));
    }
}
