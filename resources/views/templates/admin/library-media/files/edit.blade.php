@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($file)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Media library'), 'detail' => $file->name]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Media library')]) }}
        @endif
    </h1>
    <hr>
    <form action="{{ $file ? route('libraryMedia.file.update', $file) : route('libraryMedia.file.store') }}"
          method="POST"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if($file)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('libraryMedia.files.index')->containerClasses(['mr-3']) }}
            @if($file){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('File') }}">
                    {{ inputFile()->name('media')
                        ->value(optional(optional($file)->getFirstMedia('media'))->file_name)
                        ->uploadedFile(fn() => trim(view('components.admin.library-media.thumb', ['file' => $file])))
                        ->showRemoveCheckbox(false)
                        ->componentHtmlAttributes(['required'])
                        ->caption((new App\Models\LibraryMedia\LibraryMediaFile)->getMediaCaption('media')) }}
                    {{ inputText()->name('name')
                        ->locales(supportedLocaleKeys())
                        ->model($file)
                        ->componentHtmlAttributes(['required']) }}
                    {{ select()->name('category_id')
                        ->model($file)
                        ->options((new App\Models\LibraryMedia\LibraryMediaCategory)->orderBy('name')->get()->map(fn(App\Models\LibraryMedia\LibraryMediaCategory $libraryMediaCategory) => ['id' => $category->id, 'name' => $category->name]), 'id', 'name')
                        ->componentHtmlAttributes(['required', 'data-selector']) }}
                </x-admin.forms.card>
            </div>
            @if($file)
                <x-admin.forms.card title="{{ __('Clipboard copy') }}">
                    <p>{{ __('Click on buttons below to copy the related content to your clipboard.') }}</p>
                    @include('components.admin.library-media.clipboard-copy.buttons')
                </x-admin.forms.card>
            @endif
        </div>
    </form>
@endsection
