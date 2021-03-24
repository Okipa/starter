@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($cookieCategory)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Cookies'), 'entity' => __('Categories'), 'detail' => $cookieCategory->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Cookies'), 'entity' => __('Categories')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $cookieCategory ? route('cookie.category.update', $cookieCategory) : route('cookie.category.store') }}"
          novalidate>
        @csrf
        @if($cookieCategory)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('news.categories.index')->containerClasses(['mr-3']) }}
            @if($cookieCategory){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Identity') }}">
                    {{ inputText()->name('unique_key')
                        ->model($cookieCategory)
                        ->componentHtmlAttributes(['required', 'data-kebabcase']) }}
                    {{ inputText()->name('title')
                        ->locales(supportedLocaleKeys())
                        ->model($cookieCategory)
                        ->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('description')
                        ->locales(supportedLocaleKeys())
                        ->model($cookieCategory) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
