@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($page)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Pages'), 'detail' => $page->nav_title]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Pages')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $page ? route('page.update', $page) : route('page.store') }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if($page)
            @method('PUT')
        @endif
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
                    {{ inputText()->name('nav_title')
                        ->locales(supportedLocaleKeys())
                        ->model($page)
                        ->componentHtmlAttributes(['required']) }}
                    @if(! $page)
                        {{ inputText()->name('unique_key')
                            ->model($page)
                            ->prepend('<i class="fas fa-key fa-fw"></i>')
                            ->componentHtmlAttributes(['required', 'data-snakecase', 'data-autofill-from' => '#text-nav-title']) }}
                    @endif
                    {{ inputText()->name('slug')
                        ->locales(supportedLocaleKeys())
                        ->model($page)
                        ->prepend(fn(string $locale) => route('page.show', '', false, $locale) . '/')
                        ->componentHtmlAttributes(['required', 'data-kebabcase', 'data-autofill-from' => '#text-nav-title']) }}
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
    </form>
    <hr>
    @if($page)
        {!! $page->displayAdminPanel() !!}
    @else
        @include('components.admin.brickables.manage-content-once-created')
    @endif
@endsection
