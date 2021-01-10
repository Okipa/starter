<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\TitleDescriptionPageContent;
use Illuminate\Contracts\View\View;

class ContactPageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function show(): View
    {
        $pageContent = TitleDescriptionPageContent::firstOrCreate(['unique_key' => 'contact_page_content']);
        $pageContent->displaySeoMeta();
        $css = mix('/css/templates/front/contact/page/show.css');

        return view('templates.front.contact.page.show', compact('pageContent', 'css'));
    }
}
