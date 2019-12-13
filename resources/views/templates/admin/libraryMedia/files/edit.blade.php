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
                {{ bsFile()->name('media')
                    ->value(optional(optional($file)->getFirstMedia('medias'))->file_name)
                    ->uploadedFile(function() use($file) {
                        return $file
                            ? '<div class="mb-2">' . view('components.admin.table.library-media.thumb', compact('file')) . '</div>'
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\LibraryMediaFile)->constraintsLegend('medias')) }}
                <h3 class="pt-4">@lang('File')</h3>
                {{ bsText()->name('name')
                    ->locales(supportedLocaleKeys())
                    ->model($file)
                    ->containerHtmlAttributes(['required']) }}
                {{ bsSelect()->name('category_id')
                    ->model($file)
                    ->options((new \App\Models\LibraryMediaCategory)->get()->map(function($category){
                        $array = $category->toArray();
                        $array['name'] = $category->name;

                        return $array;
                    })->sortBy('name'), 'id', 'name')
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                @if(! $file || optional($file)->canBeDisplayed)
                    {{ bsToggle()->name('downloadable')
                        ->checked(optional($file)->downloadable ?? false)
                        ->containerClasses(['form-group', 'mt-4']) }}
                @endif
                @if($file)
                    <h3 class="pt-4">@lang('Clipboard copy')</h3>
                    {{ bsText()->name('url')
                        ->label(__('URL'))
                        ->prepend(false)
                        ->value($file->getFirstMedia('medias')->getFullUrl())
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['disabled']) }}
                    <div class="form-group">
                        <button type="button"
                                class="btn btn-outline-primary clipboard-copy"
                                data-library-media-id="{{ $file->id }}"
                                data-type="url">
                            <i class="fas fa-link fa-fw"></i> @lang('Clipboard copy')
                        </button>
                    </div>
                    {{ bsTextarea()->name('html')
                        ->label(__('library-media.labels.html'))
                        ->prepend(false)
                        ->value(trim(view('components.admin.table.library-media.html-clipboard-content', compact('file'))->toHtml()))
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['rows' => 6, 'disabled']) }}
                    <div class="form-group">
                        <button type="button"
                                class="btn btn-outline-primary clipboard-copy"
                                data-library-media-id="{{ $file->id }}"
                                data-type="html">
                            <i class="fas fa-link fa-fw"></i> @lang('Clipboard copy')
                        </button>
                    </div>
                @endif
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('libraryMedia.files.index')->containerClasses(['mr-2']) }}
                    @if($file){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
