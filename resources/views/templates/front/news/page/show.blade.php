@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {!! $pageContent->displayBricks() !!}
    </div>
    <div class="container my-3">
        <a href="{{ route('feeds.news') }}"
           title="{{ __(config('feed.feeds.news.title')) }}"
           target="_blank">
            <span class="fa-stack text-primary">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fas fa-rss fa-stack-1x fa-inverse"></i>
            </span>
            {{ __(config('feed.feeds.news.title')) }}
        </a>
    </div>
    <div class="container my-3">
        <div class="row">
            <form class="col d-flex align-items-end" novalidate>
                {{ select()->name('category_id')
                    ->options(App\Models\News\NewsCategory::orderBy('name')->get()->map(fn(App\Models\News\NewsCategory $category) => [
                        'id' => $category->id,
                        'name' => $category->name
                    ]), 'id', 'name')
                    ->selected('id', (int) request()->category_id)
                    ->containerClasses(['mb-0']) }}
                {{ submitValidate()->prepend('<i class="fas fa-filter fa-fw"></i>')
                    ->label(__('Filter'))
                    ->containerClasses(['ms-3']) }}
                @if(request()->has(['category_id']))
                    {{ buttonBack()->route('news.page.show')->label(__('Reset'))->containerClasses(['ms-3']) }}
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
                                {!! $image->img('card', ['class' => 'img-fluid card-img-top', 'alt' => $article->title]) !!}
                            </div>
                        @endif
                        <div class="card-body">
                            <h2 class="h5 card-title">{{ $article->title }}</h2>
                            <p class="small mt-n2">{{ Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</p>
                            @if($article->categories->isNotEmpty())
                                <div class="card-text small my-n1">
                                    @foreach($article->categories as $category)
                                        <a class="btn btn-secondary btn-sm my-1"
                                           href="{{ route('news.page.show', ['category_id' => $category->id]) }}"
                                           title="{{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <p class="card-text description mt-3">{!! Str::limit(strip_tags((new Parsedown)->text($article->description)), 500) !!}</p>
                            <a class="btn btn-primary"
                               href="{{ route('news.article.show', $article->slug) }}"
                               title="{{ __('Know more') }}">
                                {{ __('Know more') }}
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
