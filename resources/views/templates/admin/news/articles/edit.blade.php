@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-paper-plane fa-fw"></i>
        @if($article)
            @lang('breadcrumbs.parent.edit', [
                'entity' => __('Articles'), 'detail' => $article->name,
                'parent' => __('News')
            ])
        @else
            @lang('breadcrumbs.parent.create', [
                'entity' => __('Articles'),
                'parent' => __('News')
            ])
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
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Media')</h3>
                @php($illustration = optional($article)->getFirstMedia('illustrations'))
                {{ bsFile()->name('illustration')
                    ->value(optional($illustration)->file_name)
                    ->uploadedFile(function() use ($illustration) {
                        return $illustration
                            ? image()->src($illustration->getUrl('thumb'))
                                ->linkUrl($illustration->getUrl())
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\NewsArticle)->constraintsLegend('illustrations')) }}
                <h3 class="pt-4">@lang('Identity')</h3>
                {{ bsText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('url')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(route('news.article.show', '') . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('Information')</h3>
                {{ bsSelect()->name('category_ids')
                    ->model($article)
                    ->prepend('<i class="fas fa-tags"></i>')
                    ->options((new \App\Models\NewsCategory)->get()->map(function($category){
                        $array = $category->toArray();
                        $array['name'] = $category->name;

                        return $array;
                    })->sortBy('name'), 'id', 'name')
                    ->multiple()
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsTextarea()->name('description')
                    ->locales(supportedLocaleKeys())
                    ->model($article)
                    ->prepend(false)
                    ->componentClasses(['editor']) }}
                <h3 class="pt-4">@lang('Publication')</h3>
                {{ bsText()->name('published_at')
                    ->value(($article ? $article->published_at : now())->format('d/m/Y H:i'))
                    ->prepend('<i class="fas fa-calendar-alt"></i>')
                    ->componentClasses(['datetime-picker'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsToggle()->name('active')->model($article) }}
                @include('components.admin.seo.meta-tags', ['model' => $article])
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('news.articles.index')->containerClasses(['mr-2']) }}
                    @if($article){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
