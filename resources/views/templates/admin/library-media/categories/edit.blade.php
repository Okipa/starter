@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Media library'), 'entity' => __('Categories'), 'detail' => $category->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Media library'), 'entity' => __('Categories')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $category ? route('libraryMedia.category.update', $category) : route('libraryMedia.category.store') }}"
          novalidate>
        @csrf
        @if($category)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('libraryMedia.categories.index')->containerClasses(['mr-3']) }}
            @if($category){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Information') }}">
                    {{ inputText()->name('title')
                        // Todo: remove the line below if your app is not multilingual.
                        ->locales(supportedLocaleKeys())
                        ->model($category)
                        ->componentHtmlAttributes(['required']) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
