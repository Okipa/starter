<?php

namespace App\Services\News;

use App\Models\NewsArticle;
use App\Services\Service;
use Okipa\LaravelTable\Table;

class ArticlesService extends Service implements ArticlesServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(NewsArticle::class)->routes([
            'index' => ['name' => 'news.articles'],
            'create' => ['name' => 'news.article.create'],
            'edit' => ['name' => 'news.article.edit'],
            'destroy' => ['name' => 'news.article.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (NewsArticle $newsArticle) {
            return [
                'data-confirm' => __('notifications.parent.destroyConfirm', [
                    'parent' => __('News'),
                    'entity' => __('Articles'),
                    'name' => $newsArticle->title,
                ]),
            ];
        });
        $table->column('thumb')->html(function (NewsArticle $newsArticle) {
            return view('components.admin.table.image', ['image' => $newsArticle->getFirstMedia('illustrations')]);
        });
        $table->column('title')->stringLimit(50)->sortable()->searchable();
        $table->column()->title(__('validation.attributes.category_ids'))->html(function (NewsArticle $newsArticle) {
            return $newsArticle->categories->pluck('title')->map(function ($title) {
                return $title
                    ? '<button class="btn btn-sm btn-outline-primary m-1 no-click">' . $title . '</button>'
                    : null;
            })->implode(' ');
        });
        $table->column()->title(__('components.table.link'))->html(function (NewsArticle $newsArticle) {
            return view('components.admin.table.link', [
                'url' => route('news.article.show', $newsArticle->url),
                'active' => $newsArticle->active,
            ]);
        });
        $table->column('active')->sortable()->html(function (NewsArticle $newsArticle) {
            return view('components.admin.table.active', [
                'active' => $newsArticle->active,
            ]);
        });
        $table->column('published_at')->dateTimeFormat('d/m/Y H:i')->sortable(true);

        return $table;
    }
}
