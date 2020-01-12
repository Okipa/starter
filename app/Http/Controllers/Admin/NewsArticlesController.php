<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\ArticleStoreRequest;
use App\Http\Requests\News\ArticleUpdateRequest;
use App\Models\NewsArticle;
use App\Services\News\ArticlesService;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;

class NewsArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param \App\Http\Requests\News\ArticleStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(ArticleStoreRequest $request)
    {
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
                'name' => $article->title,
            ]));
    }

    /**
     * @param \App\Models\NewsArticle $article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param \App\Models\NewsArticle $article
     * @param \App\Http\Requests\News\ArticleUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(NewsArticle $article, ArticleUpdateRequest $request)
    {
        $article->update($request->validated());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        (new SeoService)->saveSeoTagsFromRequest($article, $request);

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name' => $article->title,
        ]));
    }

    /**
     * @param \App\Models\NewsArticle $article
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsArticle $article)
    {
        $name = $article->title;
        $article->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name' => $name,
        ]));
    }
}
