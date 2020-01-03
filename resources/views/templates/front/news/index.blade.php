@extends('layouts.front.full')
@section('template')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1>@lang('News')</h1>
            </div>
            @foreach($articles as $article)
                <div class="col-sm-4 py-3">
                    <div class="card">
                        <img src="{{ mix('/images/lazy/pixel.png') }}"
                             data-src="{{ $article->getFirstMediaUrl('illustrations', 'card') }}"
                             class="card-img-top lozad"
                             alt="{{ $article->title }}">
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
                            <p class="card-text shave description">{!! Str::limit(strip_tags((new Parsedown)->text($article->description)), 500) !!}</p>
                            <a class="btn btn-primary load-on-click"
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
