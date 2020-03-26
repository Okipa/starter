@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {{ Brickables::displayBricks($pageContent) }}
    </div>
    <div class="container">
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
    <div class="container mt-4 mb-5">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-sm-6 col-lg-4 my-3">
                    <div class="card">
                        @if($image = $article->getFirstMedia('illustrations'))
                            {!! $image->img('card', ['class' => 'w-100 card-img-top', 'alt' => $article->title]) !!}
                        @endif
                        <div class="card-body">
                            <h2 class="h5 card-title">{{ $article->title }}</h2>
                            <p class="small mt-n2">{{ Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</p>
                            @if($article->categories->isNotEmpty())
                                <p class="card-text small">
                                    @foreach($article->categories as $category)
                                        <a class="btn btn-secondary btn-sm"
                                           href="{{ route('news', ['category_id' => $category->id]) }}"
                                           title="{{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </p>
                            @endif
                            <p class="card-text description">{!! Str::limit(strip_tags((new Parsedown)->text($article->description)), 500) !!}</p>
                            <a class="btn btn-primary"
                               href="{{ route('news.article.show', $article->url) }}"
                               title="@lang('Know more')">
                                @lang('Know more')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
