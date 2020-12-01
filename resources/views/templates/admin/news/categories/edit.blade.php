@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            @lang('breadcrumbs.parent.edit', ['parent' => __('News'), 'entity' => __('Categories'), 'detail' => $category->name])
        @else
            @lang('breadcrumbs.parent.create', ['parent' => __('News'), 'entity' => __('Categories')])
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
                    ->componentHtmlAttributes(['data-new-window'])
                    ->containerClasses(['ml-3']) }}
            @endif
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
