@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {!! $pageContent->displayBricks() !!}
    </div>
    <div class="container my-3">
        <a class="new-window"
           href="{{ route('feeds.news') }}"
           title="@lang(config('feed.feeds.news.title'))">
            <span class="fa-stack text-primary">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fas fa-rss fa-stack-1x fa-inverse"></i>
            </span>
            @lang(config('feed.feeds.news.title'))
        </a>
    </div>
    <div class="container my-3">
        <div class="row">
            <form class="col d-flex align-items-end">
                {{ select()->name('category_id')
                    ->options((new App\Models\News\NewsCategory)->orderBy('name')->get()->map(fn(App\Models\News\NewsCategory $category) => ['id' => $category->id, 'name' => $category->name]), 'id', 'name')
                    ->selected('id', (int) request()->category_id)
                    ->componentClasses(['selector'])
                    ->containerClasses(['mb-0']) }}
                {{ submitValidate()->prepend('<i class="fas fa-filter fa-fw"></i>')
                    ->label(__('Filter'))
                    ->containerClasses(['ml-3', 'mb-0']) }}
                @if(request()->has(['category_id']))
                    {{ buttonBack()->route('news.articles.index')->label(__('Reset'))->containerClasses(['ml-3']) }}
                @endif
            </form>
        </div>
    </div>
    <div class="container mt-3 mb-5">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-sm-6 col-lg-4 my-3">
                    <div class="card">
                        @if($image = $article->getFirstMedia('illustrations'))
                            <div>
                                {!! $image->img('card', ['class' => 'w-100 card-img-top', 'alt' => $article->title]) !!}
                            </div>
                        @endif
                        <div class="card-body">
                            <h2 class="h5 card-title">{{ $article->title }}</h2>
                            <p class="small mt-n2">{{ Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</p>
                            @if($article->categories->isNotEmpty())
                                <p class="card-text small">
                                    @foreach($article->categories as $category)
                                        <a class="btn btn-secondary btn-sm"
                                           href="{{ route('news.page.show', ['category_id' => $category->id]) }}"
                                           title="{{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </p>
                            @endif
                            <p class="card-text description">{!! Str::limit(strip_tags((new Parsedown)->text($article->description)), 500) !!}</p>
                            <a class="btn btn-primary"
                               href="{{ route('news.article.show', $article->slug) }}"
                               title="@lang('Know more')">
                                @lang('Know more')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex flex-fill justify-content-center my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
