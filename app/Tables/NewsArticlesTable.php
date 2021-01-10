<?php

namespace App\Tables;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Illuminate\Support\Str;
use Livewire\Livewire;
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
        return (new Table())->model(NewsArticle::class)
            ->routes([
                'index' => ['name' => 'news.articles.index'],
                'create' => ['name' => 'news.article.create'],
                'edit' => ['name' => 'news.article.edit'],
                'destroy' => ['name' => 'news.article.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(NewsArticle $article) => [
                'data-confirm' => __('notifications.parent.destroyConfirm', [
                    'parent' => __('News'),
                    'entity' => __('Articles'),
                    'name' => $article->title,
                ]),
            ]);
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
        $table->column('thumb')->html(fn(NewsArticle $article) => view(
            'components.admin.media.thumb',
            ['image' => $article->getFirstMedia('illustrations')]
        ));
        $table->column('title')->stringLimit(25)->sortable()->searchable();
        $table->column()
            ->title(__('Categories'))
            ->value(fn(NewsArticle $article) => $article->categories->map(function (NewsCategory $category) {
                $category->name = Str::limit($category->name, 25);

                return $category;
            })->implode('name', ', '));
        $table->column()->title(__('Display'))->html(fn(NewsArticle $article) => view(
            'components.admin.table.display',
            ['url' => route('news.article.show', $article->slug), 'active' => $article->active]
        ));
        $table->column('active')
            ->sortable()
            ->html(fn(NewsArticle $article) => Livewire::mount('boolean-toggle', [
                'model' => $article,
                'field' => 'active',
                'componentClassToRefresh' => get_class($this),
            ])->html());
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('published_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
