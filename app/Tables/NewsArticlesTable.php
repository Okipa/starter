<?php

namespace App\Tables;

use App\Models\News\NewsArticle;
use Illuminate\Support\Facades\Lang;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class NewsArticlesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table)->model(NewsArticle::class)->routes([
            'index' => ['name' => 'news.articles.index'],
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
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable();
        $table->column('thumb')->html(function (NewsArticle $newsArticle) {
            return view('components.admin.table.image', ['image' => $newsArticle->getFirstMedia('illustrations')]);
        });
        $table->column('title')->stringLimit(50)->sortable()->searchable();
        $table->column()->title(__('Categories'))->html(function (NewsArticle $newsArticle) {
            return $newsArticle->categories->pluck('name')->map(function ($name) {
                return $name
                    ? '<button class="btn btn-sm btn-outline-primary m-1 no-click">' . $name . '</button>'
                    : null;
            })->implode(' ');
        });
        $table->column()->title(__('Display'))->html(fn(NewsArticle $newsArticle) => view(
            'components.admin.table.display',
            ['url' => route('news.article.show', $newsArticle->slug), 'active' => $newsArticle->active]
        ));
        $table->column('active')->sortable()->html(fn(NewsArticle $newsArticle) => view(
            'components.admin.table.active',
            ['active' => $newsArticle->active]
        ));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('published_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
