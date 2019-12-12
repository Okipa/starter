<?php

namespace DynamicPages\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Seo\SeoService;
use DynamicPages\Models\DynamicPage;

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

        return view('dynamic-pages::templates.front.dynamic-pages.show', compact('dynamicPage', 'css'));
    }
}
