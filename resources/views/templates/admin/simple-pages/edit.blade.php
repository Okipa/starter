@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($simplePage)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Simple pages'), 'detail' => $simplePage->title])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Simple pages')])
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
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Identity')</h3>
                {{ inputText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->model($simplePage)
                    ->containerHtmlAttributes(['required']) }}
                @if(! $simplePage)
                    {{ inputText()->name('slug')
                        ->model($simplePage)
                        ->prepend('<i class="fas fa-key fa-fw"></i>')
                        ->componentClasses(['slugify'])
                        ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                        ->containerHtmlAttributes(['required'])}}
                @endif
                {{ inputText()->name('url')
                    ->locales(supportedLocaleKeys())
                    ->model($simplePage)
                    ->prepend(route('simplePage.show', '/') . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('Publication')</h3>
                {{ inputToggle()->name('active')->model($simplePage) }}
                @include('components.admin.seo.meta-tags', ['model' => $simplePage])
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('simplePages.index')->containerClasses(['mr-2']) }}
                    @if($simplePage){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
    @if($simplePage)
        {{ Brickables::adminPanel($simplePage)  }}
    @endif
    </div>
@endsection
