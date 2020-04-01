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
                    ->uploadedFile(fn() => trim(view('components.admin.table.library-media.thumb', ['file' => $file])))
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
                    ->options((new \App\Models\LibraryMedia\LibraryMediaCategory)->get()->map(function($category){
                        $array = $category->toArray();
                        $array['name'] = $category->name;

                        return $array;
                    })->sortBy('name'), 'id', 'name')
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                @if(! $file || optional($file)->canBeDisplayed)
                    {{ inputToggle()->name('downloadable')
                        ->checked(optional($file)->downloadable ?? false)
                        ->containerClasses(['form-group', 'mt-4']) }}
                @endif
                @if($file)
                    <h3>@lang('Clipboard copy')</h3>
                    {{ inputText()->name('url')
                        ->label(__('URL'))
                        ->prepend('<i class="fas fa-link fa-fw"></i>')
                        ->value($file->getFirstMedia('medias')->getFullUrl())
                        ->append(view('components.admin.library-media.url-copy-link', compact('file')))
                        ->componentHtmlAttributes(['disabled']) }}
                    {{ textarea()->name('html')
                        ->locales(supportedLocaleKeys())
                        ->label(__('library-media.labels.html'))
                        ->prepend('<i class="fas fa-code fa-fw"></i>')
                        ->value(fn($locale) => trim(view('components.admin.table.library-media.html-clipboard-content', ['file' => $file, 'locale' => $locale])))
                        ->append(view('components.admin.library-media.html-copy-link', compact('file')))
                        ->componentHtmlAttributes(['disabled']) }}
                @endif
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('libraryMedia.files.index')->containerClasses(['mr-2']) }}
                    @if($file){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
