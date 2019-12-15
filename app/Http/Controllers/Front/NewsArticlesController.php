<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\ArticlesIndexRequest;
use App\Models\NewsArticle;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsArticlesController extends Controller
{
    /**
     * @param ArticlesIndexRequest $request
     *
     * @return Factory|View
     * @throws Exception
     */
    public function index(ArticlesIndexRequest $request)
    {
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));
        $query = (new NewsArticle)->with(['media', 'categories'])
            ->where('active', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
        if ($request->category_id) {
            $query->whereHas('categories', function ($category) use ($request) {
                $category->where('id', $request->category_id);
            });
        }
        $articles = $query->paginate(6)->appends($request->only('category_id'));
        $css = mix('/css/news/index.css');

        return view('templates.front.news.index', compact('articles', 'css'));
    }

    /**
     * @param NewsArticle $article
     *
     * @return Factory|RedirectResponse|View
     * @throws Exception
     */
    public function show(NewsArticle $article)
    {
//        /** @var NewsArticle $article */
//        $article = (new NewsArticle)->with(['media', 'categories'])
//            ->where('url', 'LIKE', '%' . $url . '%')
//            ->where('active', true)
//            ->where('published_at', '<=', now())
//            ->firstOrFail();
//        if ($article->url !== $url) {
//            return redirect()->route('news.article.show', $article->url);
//        }
        (new SeoService)->displayMetaTagsFromModel($article);
        $css = mix('/css/news/show.css');

//        $parameters = function ($locale) use ($article) {
//            return $article->getTranslation('url', $locale);
//        };



//        $parameters = [];
//        $originalLocale = app()->getLocale();
//        foreach (supportedLocales() as $localeKey => $locale) {
//            app()->setLocale($localeKey);
//            foreach (\Route::current()->parameters() as $attribute  => $value) {
//                if($value instanceof Model) {
//                    $parameters[] = $value->getRouteKey();
////                    dd($value->getTranslation('url', 'en'));
//                }
//            }
//        }
//        app()->setLocale($originalLocale);
//        dd($parameters);


        return view('templates.front.news.show', compact('article', 'css'));
    }
}
