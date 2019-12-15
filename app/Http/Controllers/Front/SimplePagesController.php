<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SimplePage;
use App\Services\Seo\SeoService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SimplePagesController extends Controller
{
    /**
     * @param SimplePage $page
     *
     * @return Factory|View
     * @throws Exception
     */
    public function show(SimplePage $page)
    {
        (new SeoService)->displayMetaTagsFromModel($page);
        $css = mix('/css/simple-pages/show.css');

        return view('templates.front.simple-pages.show', compact('page', 'css'));
    }
}
