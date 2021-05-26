@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('News'), 'entity' => __('Categories'), 'detail' => $category->name]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('News'), 'entity' => __('Categories')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $category ? route('news.category.update', $category) : route('news.category.store') }}"
          novalidate>
        @csrf
        @if($category)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('news.categories.index')->containerClasses(['mr-3']) }}
            @if($category){{ submitUpdate() }}@else{{ submitCreate() }}@endif
            @if(optional($category)->active)
                {{ buttonLink()->route('news.category.show', [$category])
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
                <x-admin.forms.card title="{{ __('Informations') }}">
                    {{ inputText()->name('name')
                        // Todo: remove the line below if your app is not multilingual.
                        ->locales(supportedLocaleKeys())
                        ->model($category)
                        ->componentHtmlAttributes(['required']) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
