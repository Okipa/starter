<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News\NewsArticle;
use Illuminate\View\View;

class NewsArticlesController extends Controller
{
    /**
     * @param \App\Models\News\NewsArticle $article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(NewsArticle $article): View
    {
        $article->displaySeoMeta();
        $css = mix('/css/news/show.css');

        return view('templates.front.news.articles.show', compact('article', 'css'));
    }
}
