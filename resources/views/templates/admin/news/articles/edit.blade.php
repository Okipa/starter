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
                @if($article->active)
                    {{ buttonLink()->route('news.article.show', [$article->url])
                        ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                        ->label(__('Display'))
                        ->componentClasses(['btn-primary', 'new-window']) }}
                @endif
            </div>
            <div class="card-body">
                <h3>@lang('Media')</h3>
                @php($image = optional($article)->getFirstMedia('illustrations'))
                {{ inputFile()->name('image')
                    ->value(optional($image)->file_name)
                    ->uploadedFile(fn() => $image ? image()->src($image->getUrl('thumb'))->linkUrl($image->getUrl())->linkTitle($image->name) : null)
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->caption((new \App\Models\News\NewsArticle)->constraintsCaption('illustrations')) }}
                <h3>@lang('Identity')</h3>
                {{ inputText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->containerHtmlAttributes(['required']) }}
                {{ inputText()->name('url')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(route('news.article.show', '') . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3>@lang('Information')</h3>
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
                    ->containerHtmlAttributes(['required']) }}
                {{ textarea()->name('description')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(false)
                    ->componentClasses(['editor']) }}
                <h3>@lang('Publication')</h3>
                {{ inputText()->name('published_at')
                    ->value(($article ? $article->published_at : now())->format('d/m/Y H:i'))
                    ->prepend('<i class="fas fa-calendar-alt"></i>')
                    ->componentClasses(['datetime-picker'])
                    ->containerHtmlAttributes(['required']) }}
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
