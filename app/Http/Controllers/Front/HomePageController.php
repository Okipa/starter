<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomePageController extends Controller
{
    /**
     * @return Factory|View
     * @throws Exception
     */
    public function show()
    {
        /** @var PageContent $contactPageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'home-page-content']);
        (new SeoService)->displayMetaTagsFromModel($pageContent);
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('pageContent', 'css'));
    }
}
