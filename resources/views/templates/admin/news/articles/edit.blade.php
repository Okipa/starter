@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-paper-plane fa-fw"></i>
        @if($article)
            {{ __('breadcrumbs.parent.edit', ['entity' => __('Articles'), 'detail' => $article->title, 'parent' => __('News')]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['entity' => __('Articles'), 'parent' => __('News')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $article ? route('news.article.update', $article) : route('news.article.store') }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if($article)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('news.articles.index')->containerClasses(['mr-3']) }}
            @if($article){{ submitUpdate() }}@else{{ submitCreate() }}@endif
            @if(optional($article)->active)
                {{ buttonLink()->route('news.article.show', [$article])
                    ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                    ->label(__('Display'))
                    ->componentClasses(['btn-success'])
                    ->componentHtmlAttributes(['target' => '_blank'])
                    ->containerClasses(['ml-3']) }}
            @endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Media') }}">
                    @php($image = optional($article)->getFirstMedia('illustrations'))
                    {{ inputFile()->name('illustration')
                        ->value(optional($image)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
                        ->showRemoveCheckbox(false)
                        ->componentHtmlAttributes(['required'])
                        ->caption((new App\Models\News\NewsArticle)->getMediaCaption('illustrations')) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Information') }}">
                    {{ inputText()->name('title')
                        ->locales(supportedLocaleKeys())
                        ->model($article)
                        ->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('slug')
                        ->locales(supportedLocaleKeys())
                        ->model($article)
                        ->prepend(fn(string $locale) => route('news.article.show', '', false, $locale) . '/')
                        ->componentHtmlAttributes(['required', 'data-kebabcase', 'data-autofill-from' => '#text-title']) }}
                    {{ select()->name('category_ids')
                        ->model($article)
                        ->prepend('<i class="fas fa-tags"></i>')
                        ->disablePlaceholder()
                        ->options(App\Models\News\NewsCategory::get()->map(fn(App\Models\News\NewsCategory $category) => [
                            'id' => $category->id,
                            'name' => $category->name
                        ])->sortBy('name'), 'id', 'name')
                        ->multiple()
                        ->componentHtmlAttributes(['required']) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Content') }}">
                    {{ textarea()->name('description')
                        ->locales(supportedLocaleKeys())
                        ->model($article)
                        ->prepend(null)
                        ->componentHtmlAttributes(['data-editor']) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.seo-meta-card :model="$article"/>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    {{ inputText()->name('published_at')
                        ->value(optional(optional($article)->published_at)->toW3cString() ?: now()->toW3cString())
                        ->caption(__('You can set a future publication date: this article will not be published until this date is reached.'))
                        ->prepend('<i class="fas fa-calendar-alt"></i>')
                        ->componentHtmlAttributes(['required', 'data-datetime-picker']) }}
                    {{ inputSwitch()->name('active')->model($article) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
