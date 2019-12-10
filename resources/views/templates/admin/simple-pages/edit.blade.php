@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($simplePage)
            @lang('admin.title.orphan.edit', ['entity' => __('entities.simplePages'), 'detail' => $simplePage->title])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('entities.simplePages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $simplePage ? route('simplePage.update', $simplePage) : route('simplePage.store') }}"
          method="POST">
        @csrf
        @if($simplePage)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.page')</h3>
                {{ bsText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->model($simplePage)
                    ->containerHtmlAttributes(['required']) }}
                @if(! $simplePage)
                    {{ bsText()->name('slug')
                        ->model($simplePage)
                        ->prepend('<i class="fas fa-key fa-fw"></i>')
                        ->componentClasses(['slugify'])
                        ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                        ->containerHtmlAttributes(['required'])}}
                @endif
                {{ bsText()->name('url')
                    ->locales(supportedLocaleKeys())
                    ->model($simplePage)
                    ->prepend(route('simplePage.show', '/') . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsTextarea()->name('description')
                    ->locales(supportedLocaleKeys())
                    ->model($simplePage)
                    ->prepend(false)
                    ->componentClasses(['editor']) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->model($simplePage) }}
                @include('components.admin.seo.meta-tags', ['model' => $simplePage])
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('simplePages')->containerClasses(['mr-2']) }}
                    @if($simplePage){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
