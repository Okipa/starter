<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SimplePage;
use App\Services\Seo\SeoService;

class SimplePagesController extends Controller
{
    /**
     * @param \App\Models\SimplePage $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(SimplePage $page)
    {
        (new SeoService)->displayMetaTagsFromModel($page);
        $css = mix('/css/simple-pages/show.css');

        return view('templates.front.simple-pages.show', compact('page', 'css'));
    }
}
