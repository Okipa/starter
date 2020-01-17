<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\PageContent;
use App\Services\Seo\SeoService;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'home-page-content']);
        (new SeoService)->displayMetaTagsFromModel($pageContent);
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('pageContent', 'css'));
    }
}
