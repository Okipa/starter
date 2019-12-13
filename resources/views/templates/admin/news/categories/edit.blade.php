@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            @lang('breadcrumbs.parent.edit', [
                'parent' => __('News'),
                'entity' => __('Categories'),
                'detail' => $category->name,
            ])
        @else
            @lang('breadcrumbs.parent.create', [
                'parent' => __('News'),
                'entity' => __('Categories'),
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $category ? route('news.category.update', $category) : route('news.category.store') }}"
          method="POST">
        @csrf
        @if($category)
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
                {{ bsText()->name('name')
                    ->locales(supportedLocaleKeys())
                    ->model($category)
                    ->containerHtmlAttributes(['required']) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('news.categories.index')->containerClasses(['mr-2']) }}
                    @if($category){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
