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
    <x-form::form method="{{ $cookieCategory ? 'PUT' : 'POST' }}"
          action="{{ $cookieCategory ? route('cookie.category.update', $cookieCategory) : route('cookie.category.store') }}"
          :bind="$cookieCategory">
        <div class="d-flex">
            {{ buttonBack()->route('cookie.categories.index')->containerClasses(['me-3']) }}
            @if($cookieCategory){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Information') }}">
                    <x-form::input name="unique_key" data-snakecase required/>
                    <x-form::input name="title" :locales="supportedLocaleKeys()" required/>
                    {{ textarea()->name('description')
                        // Todo: remove the line below if your app is not multilingual.
                        ->locales(supportedLocaleKeys())
                        ->model($cookieCategory) }}
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
