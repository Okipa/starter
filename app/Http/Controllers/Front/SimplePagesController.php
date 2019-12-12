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
     * @param string $url
     *
     * @return Factory|View
     * @throws Exception
     */
    public function show(string $url)
    {
        $simplePage = (new SimplePage)->where('url', 'LIKE', '%' . $url . '%')
            ->where('active', true)
            ->firstOrFail();
        if ($simplePage->url !== $url) {
            return redirect()->route('simplePage.show', $simplePage->url);
        }
        (new SeoService)->displayMetaTagsFromModel($simplePage);
        $css = mix('/css/simple-pages/show.css');

        return view('templates.front.simple-pages.show', compact('simplePage', 'css'));
    }
}
