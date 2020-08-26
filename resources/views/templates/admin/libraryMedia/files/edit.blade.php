@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($file)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Media library'), 'detail' => $file->name])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Media library')])
        @endif
    </h1>
    <hr>
    <form action="{{ $file ? route('libraryMedia.file.update', $file) : route('libraryMedia.file.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($file)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Media')</h3>
                {{ inputFile()->name('media')
                    ->value(optional(optional($file)->getFirstMedia('medias'))->file_name)
                    ->uploadedFile(fn() => trim(view('components.admin.library-media.thumb', ['file' => $file])))
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->caption((new \App\Models\LibraryMedia\LibraryMediaFile)->getMediaCaption('medias')) }}
                <h3>@lang('File')</h3>
                {{ inputText()->name('name')
                    ->locales(supportedLocaleKeys())
                    ->model($file)
                    ->containerHtmlAttributes(['required']) }}
                {{ select()->name('category_id')
                    ->model($file)
                    ->options((new App\Models\LibraryMedia\LibraryMediaCategory)->orderBy('name')->get()->map(fn(App\Models\LibraryMedia\LibraryMediaCategory $category) => ['id' => $category->id, 'name' => $category->name]), 'id', 'name')
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                @if($file)
                    <h3>@lang('Clipboard copy')</h3>
                    @include('components.admin.library-media.clipboard-copy.buttons')
                @endif
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('libraryMedia.files.index')->containerClasses(['mr-2']) }}
                    @if($file){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
