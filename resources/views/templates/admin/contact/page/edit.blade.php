@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-desktop fa-fw"></i>
        @lang('breadcrumbs.orphan.edit', ['entity' => __('Contact'), 'detail' => __('Page')])
    </h1>
    <hr>
    <form class="w-100"
          method="POST"
          action="{{ route('contact.page.update') }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @method('PUT')
        <div class="d-flex">
            {{ submitUpdate() }}
            {{ buttonLink()->route('contact.page.show')
                ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                ->label(__('Display'))
                ->componentClasses(['btn-success'])
                ->componentHtmlAttributes(['data-new-window'])
                ->containerClasses(['ml-3']) }}
        </div>
        <p>
            @include('components.common.form.notice')
        </p>
        <div class="card-columns">
            @include('components.admin.seo.meta', ['model' => $pageContent])
        </div>
    </form>
    <hr class="mt-n1">
    @if($pageContent)
        {!! $pageContent->displayAdminPanel() !!}
    @else
        @include('components.admin.brickables.manage-content-once-created')
    @endif
@endsection
