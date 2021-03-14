@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-desktop fa-fw"></i>
        {{ __('breadcrumbs.orphan.edit', ['entity' => __('Contact'), 'detail' => __('Page')]) }}
    </h1>
    <hr>
    <form method="POST"
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
                ->componentHtmlAttributes(['target' => '_blank'])
                ->containerClasses(['ms-3']) }}
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.seo-meta-card :model="$pageContent"/>
            </div>
        </div>
    </form>
    <hr>
    {!! $pageContent->displayAdminPanel() !!}
@endsection
