<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\ArticleStoreRequest;
use App\Http\Requests\News\ArticleUpdateRequest;
use App\Models\News\NewsArticle;
use App\Tables\NewsArticlesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsArticlesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = (new NewsArticlesTable)->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));

        return view('templates.admin.news.articles.index', compact('table'));
    }

    public function create(): View
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
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        /** @var \App\Models\News\NewsArticle $article */
        $article = (new NewsArticle)->create($request->validated());
        $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        $article->categories()->sync($request->category_ids);
        $article->saveSeoMetaFromRequest($request);

        return redirect()->route('news.articles.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('News'),
                'entity' => __('Articles'),
                'name' => $article->title,
            ]));
    }

    public function edit(NewsArticle $article): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'detail' => $article->title,
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param \App\Models\News\NewsArticle $article
     * @param \App\Http\Requests\News\ArticleUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(NewsArticle $article, ArticleUpdateRequest $request): RedirectResponse
    {
        $article->update($request->validated());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        $article->saveSeoMetaFromRequest($request);

        return redirect()->route('news.article.edit', $article)
            ->with('toast_success', __('notifications.parent.updated', [
                'parent' => __('News'),
                'entity' => __('Articles'),
                'name' => $article->title,
            ]));
    }

    /**
     * @param \App\Models\News\NewsArticle $article
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsArticle $article): RedirectResponse
    {
        $article->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name' => $article->title,
        ]));
    }
}
