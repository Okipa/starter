<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use App\Services\Seo\SeoService;

class DynamicPagesController extends Controller
{
    /**
     * @param string $url
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(string $url)
    {
        $dynamicPage = DynamicPage::active()->where('url', $url)->firstOrFail();
        (new SeoService)->displayMetaTagsFromModel($dynamicPage);
        $css = mix('/css/simple-pages/show.css');

        return view('templates.front.dynamic-pages.show', compact('dynamicPage', 'css'));
    }
}
