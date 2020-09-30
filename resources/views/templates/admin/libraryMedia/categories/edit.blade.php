@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            @lang('breadcrumbs.parent.edit', ['parent' => __('Media library'), 'entity' => __('Categories'), 'detail' => $category->name])
        @else
            @lang('breadcrumbs.parent.create', ['parent' => __('Media library'), 'entity' => __('Categories')])
        @endif
    </h1>
    <hr>
    <form action="{{ $category ? route('libraryMedia.category.update', $category) : route('libraryMedia.category.store') }}"
          method="POST">
        @csrf
        @if($category)
            @method('PUT')
        @endif()
        <div class="d-flex">
            {{ buttonBack()->route('libraryMedia.categories.index')->containerClasses(['mr-3']) }}
            @if($category){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <p>
            @include('components.common.form.notice')
        </p>
        <div class="card-columns">
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Identity')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputText()->name('name')
                        ->locales(supportedLocaleKeys())
                        ->model($category)
                        ->componentHtmlAttributes(['required']) }}
                </div>
            </div>
        </div>
    </form>
@endsection
