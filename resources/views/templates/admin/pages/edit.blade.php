@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($page)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Pages'), 'detail' => $page->nav_title])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Pages')])
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
            {{ buttonBack()->route('pages.index')->containerClasses(['mr-3']) }}
            @if($page){{ submitUpdate() }}@else{{ submitCreate() }}@endif
            @if(optional($page)->active)
                {{ buttonLink()->route('page.show', [$page->slug])
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
                        @lang('Navigation')
                    </h2>
                </div>
                <div class="card-body">
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
                </div>
            </div>
            @include('components.admin.seo.meta', ['model' => $page])
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Publication')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputSwitch()->name('active')->model($page) }}
                </div>
            </div>
        </div>
    </form>
    <hr class="mt-n1">
    @if($page)
        {!! $page->displayAdminPanel() !!}
    @else
        @include('components.admin.brickables.manage-content-once-created')
    @endif
@endsection
