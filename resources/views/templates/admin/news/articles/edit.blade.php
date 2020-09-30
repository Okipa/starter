@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-paper-plane fa-fw"></i>
        @if($article)
            @lang('breadcrumbs.parent.edit', ['entity' => __('Articles'), 'detail' => $article->title, 'parent' => __('News')])
        @else
            @lang('breadcrumbs.parent.create', ['entity' => __('Articles'), 'parent' => __('News')])
        @endif
    </h1>
    <hr>
    <form action="{{ $article ? route('news.article.update', $article) : route('news.article.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($article)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
                @if(optional($article)->active)
                    {{ buttonLink()->route('news.article.show', [$article->slug])
                        ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                        ->label(__('Display'))
                        ->componentClasses(['btn-primary', 'new-window']) }}
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">@lang('Media')</h3>
                @php($image = optional($article)->getFirstMedia('illustrations'))
                {{ inputFile()->name('illustration')
                    ->value(optional($image)->file_name)
                    ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
                    ->showRemoveCheckbox(false)
                    ->componentHtmlAttributes(['required'])
                    ->caption((new \App\Models\News\NewsArticle)->getMediaCaption('illustrations')) }}
                <h3 class="card-title">@lang('Identity')</h3>
                {{ inputText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->componentHtmlAttributes(['required']) }}
                {{ inputText()->name('slug')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(fn(string $locale) => route('news.article.show', '', false, $locale) . '/')
                    ->componentHtmlAttributes(['required', 'data-kebabcase', 'data-autofill-from' => '#text-title']) }}
                <h3 class="card-title">@lang('Information')</h3>
                {{ select()->name('category_ids')
                    ->model($article)
                    ->prepend('<i class="fas fa-tags"></i>')
                    ->options((new \App\Models\News\NewsCategory)->get()->map(function($category){
                        $array = $category->toArray();
                        $array['name'] = $category->name;

                        return $array;
                    })->sortBy('name'), 'id', 'name')
                    ->multiple()
                    ->componentClasses(['selector'])
                    ->componentHtmlAttributes(['required']) }}
                {{ textarea()->name('description')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(null)
                    ->componentClasses(['editor']) }}
                <h3 class="card-title">@lang('Publication')</h3>
                {{ inputText()->name('published_at')
                    ->value(($article ? $article->published_at : now())->format('d/m/Y H:i'))
                    ->prepend('<i class="fas fa-calendar-alt"></i>')
                    ->componentClasses(['datetime-picker'])
                    ->componentHtmlAttributes(['required']) }}
                {{ inputToggle()->name('active')->model($article) }}
                @include('components.admin.seo.meta', ['model' => $article])
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('news.articles.index')->containerClasses(['mr-2']) }}
                    @if($article){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
