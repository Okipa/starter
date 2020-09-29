@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($page)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Pages'), 'detail' => $page->nav_title])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Pages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $page ? route('page.update', $page) : route('page.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($page)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
                @if(optional($page)->active)
                    {{ buttonLink()->route('page.show', [$page->slug])
                        ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                        ->label(__('Display'))
                        ->componentClasses(['btn-primary', 'new-window']) }}
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">@lang('Navigation')</h3>
                {{ inputText()->name('nav_title')
                    ->locales(supportedLocaleKeys())
                    ->model($page)
                    ->containerHtmlAttributes(['required']) }}
                @if(! $page)
                    {{ inputText()->name('unique_key')
                        ->model($page)
                        ->prepend('<i class="fas fa-key fa-fw"></i>')
                        ->componentHtmlAttributes(['data-snakecase', 'data-autofill-from' => '#text-nav-title'])
                        ->containerHtmlAttributes(['required'])}}
                @endif
                {{ inputText()->name('slug')
                    ->locales(supportedLocaleKeys())
                    ->model($page)
                    ->prepend(fn(string $locale) => route('page.show', '', false, $locale) . '/')
                    ->componentHtmlAttributes(['data-kebabcase', 'data-autofill-from' => '#text-nav-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="card-title">@lang('Publication')</h3>
                {{ inputToggle()->name('active')->model($page) }}
                @include('components.admin.seo.meta', ['model' => $page])
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('pages.index')->containerClasses(['mr-2']) }}
                    @if($page){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
    @if($page)
        <div class="mt-3">
            {!! $page->displayAdminPanel() !!}
        </div>
    @endif
@endsection
