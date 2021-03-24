<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\PageContent;
use Illuminate\Contracts\View\View;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function show(): View
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = PageContent::where('unique_key', 'home_page_content')->sole();
        $pageContent->displaySeoMeta();

        return view('templates.front.home.page.show', compact('pageContent'));
    }
}
