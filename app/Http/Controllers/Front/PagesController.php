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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(Page $page): View
    {
        $page->displaySeoMeta();
        $css = mix('/css/pages/show.css');

        return view('templates.front.pages.show', compact('page', 'css'));
    }
}
