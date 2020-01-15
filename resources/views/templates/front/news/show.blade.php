@extends('layouts.front.full')
@section('template')
    <div class="container my-5">
        <div class="row">
            {{-- cover --}}
            {{ $article->getFirstMedia('illustrations')('cover') }}
            {{-- categories / sharing --}}
            <div class="d-flex flex-wrap flex-grow-1 align-items-center justify-content-between py-3">
                <div>
                    @if($article->categories->isNotEmpty())
                        @foreach($article->categories as $category)
                            <a class="btn btn-secondary btn-sm"
                               href="{{ route('news', ['category_id' => $category->id]) }}"
                               title="{{ $category->name }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <div>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://twitter.com/home?status={{ request()->url() }}"
                           title="@lang('Share on :name', ['name' => 'Twitter'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://www.linkedin.com/shareArticle?mini=true&url={{ request()->url() }}&title=&summary=&source={{ request()->getHttpHost() }}"
                           title="@lang('Share on :name', ['name' => 'Linkedin'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                           title="@lang('Share on :name', ['name' => 'Facebook'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                </div>
            </div>
            {{-- description --}}
            <div class="d-flex w-100 flex-column text mt-3">
                <h1 class="mb-4">{{ $article->title }}</h1>
                {!! (new Parsedown)->text($article->description) !!}
                <div class="mt-3">
                    <a class="btn btn-link"
                       href="{{ route('news') }}"
                       title="@lang('Back')">
                        <i class="fas fa-chevron-left fa-fw"></i>
                        @lang('Back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
