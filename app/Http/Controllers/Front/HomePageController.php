<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'home-page-content']);
        (new SeoService)->displayMetaTagsFromModel($pageContent);
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('pageContent', 'css'));
    }
}
