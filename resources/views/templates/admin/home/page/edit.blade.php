@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-desktop fa-fw"></i>
        @lang('breadcrumbs.orphan.edit', ['entity' => __('Home'), 'detail' => __('Page')])
    </h1>
    <hr>
    <form method="POST" class="w-100" action="{{ route('home.page.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
                {{ buttonLink()->route('home.page.show')
                    ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
                    ->label(__('Display'))
                    ->componentClasses(['btn-primary'])
                    ->componentHtmlAttributes(['data-new-window']) }}
            </div>
            <div class="card-body">
                @include('components.admin.seo.meta', ['model' => $pageContent])
                <div class="d-flex pt-4">
                    {{ submitUpdate() }}
                </div>
            </div>
        </div>
    </form>
    @if($pageContent)
        <div class="mt-3">
            {!! $pageContent->displayAdminPanel() !!}
        </div>
    @endif
@endsection
