<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsArticle;
use App\Http\Controllers\Controller;
use App\Services\News\ArticlesService;
use App\Http\Requests\News\ArticleStoreRequest;
use App\Http\Requests\News\ArticleUpdateRequest;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class NewsArticlesController extends Controller
{
    /**
     * @return Factory|View
     * @throws Exception
     */
    public function index()
    {
        $table = (new ArticlesService)->table();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));

        return view('templates.admin.news.articles.index', compact('table'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $article = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param ArticleStoreRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(ArticleStoreRequest $request)
    {
        $request->merge(['title' => ucfirst(strtolower($request->title))]);
        /** @var NewsArticle $article */
        $article = (new NewsArticle)->create($request->validated());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        (new SeoService)->saveSeoTagsFromRequest($article, $request);

        return redirect()->route('news.articles.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('News'),
                'entity' => __('Articles'),
                'name'   => $article->title,
            ]));
    }

    /**
     * @param NewsArticle $article
     *
     * @return Factory|View
     */
    public function edit(NewsArticle $article)
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'detail' => $article->title,
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param NewsArticle $article
     * @param ArticleUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(NewsArticle $article, ArticleUpdateRequest $request)
    {
        $request->merge(['title' => ucfirst(strtolower($request->title))]);
        $article->update($request->validated());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        (new SeoService)->saveSeoTagsFromRequest($article, $request);

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name'   => $article->title,
        ]));
    }

    /**
     * @param NewsArticle $article
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(NewsArticle $article)
    {
        $name = $article->title;
        $article->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name'   => $name,
        ]));
    }
}
