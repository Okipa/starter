@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($page)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Free pages'), 'detail' => $page->nav_title]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Free pages')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form method="{{ $page ? 'PUT' : 'POST' }}"
          action="{{ $page ? route('page.update', $page) : route('page.store') }}"
          :bind="$page"
          enctype="multipart/form-data">
        <div class="d-flex">
            {{ buttonBack()->route('pages.index')->containerClasses(['me-3']) }}
            @if($page){{ submitUpdate() }}@else{{ submitCreate() }}@endif
            @if(optional($page)->active)
                {{ buttonLink()->route('page.show', [$page->slug])
                    ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                    ->label(__('Display'))
                    ->componentClasses(['btn-success'])
                    ->componentHtmlAttributes(['target' => '_blank'])
                    ->containerClasses(['ms-3']) }}
            @endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Navigation') }}">
                    <x-form::input name="nav_title" :locales="supportedLocaleKeys()" required/>
                    @unless($page)
                        <x-form::input name="unique_key" data-autofill-from="#text-nav-title" data-snakecase required/>
                    @endunless
                    <x-form::input name="slug"
                                   :locales="supportedLocaleKeys()"
                                   :prepend="fn(string $locale) => route('page.show', '', false, $locale) . '/'"
                                   data-autofill-from="#text-nav-title"
                                   data-kebabcase
                                   required/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.seo-meta-card :model="$page"/>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    {{ inputSwitch()->name('active')->model($page) }}
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
    <hr>
    @if($page)
        {!! $page->displayAdminPanel() !!}
    @else
        @include('components.admin.brickables.manage-content-once-created')
    @endif
@endsection
