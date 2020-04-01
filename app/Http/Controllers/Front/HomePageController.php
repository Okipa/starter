<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\PageContent;
use Illuminate\View\View;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function show(): View
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'home-page-content']);
        $pageContent->displaySeoMeta();
        $css = mix('/css/home/page/show.css');

        return view('templates.front.home.page.show', compact('pageContent', 'css'));
    }
}
