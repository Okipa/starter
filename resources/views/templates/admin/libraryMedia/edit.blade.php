@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($libraryMedia)
            @lang('admin.title.orphan.edit', ['entity' => __('entities.libraryMedia'), 'detail' => $libraryMedia->name])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('entities.libraryMedia')])
        @endif
    </h1>
    <hr>
    <form action="{{ $libraryMedia ? route('libraryMedia.update', $libraryMedia) : route('libraryMedia.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($libraryMedia)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.media')</h3>
                {{ bsFile()->name('media')
                    ->value(optional(optional($libraryMedia)->getFirstMedia('medias'))->file_name)
                    ->uploadedFile(function() use($libraryMedia) {
                        return $libraryMedia
                            ? '<div class="mb-2">' . view('components.admin.table.library-media.thumb', compact('libraryMedia')) . '</div>'
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\LibraryMedia)->constraintsLegend('medias')) }}
                {{ bsText()->name('name')->model($libraryMedia)->containerHtmlAttributes(['required']) }}
                @if(! $libraryMedia || optional($libraryMedia)->canBeDisplayed)
                    {{ bsToggle()->name('downloadable')
                        ->checked(optional($libraryMedia)->downloadable ?? false)
                        ->containerClasses(['form-group', 'mt-4']) }}
                @endif
                @if($libraryMedia)
                    {{ bsText()->name('url')
                        ->label(__('library-media.labels.url'))
                        ->prepend(false)
                        ->value($libraryMedia->getFirstMedia('medias')->getFullUrl())
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['disabled']) }}
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary clipboard-copy" data-library-media-id="{{ $libraryMedia->id }}" data-type="url">
                            <i class="fas fa-link fa-fw"></i> @lang('library-media.labels.clipboardCopy')
                        </button>
                    </div>
                    {{ bsTextarea()->name('html')
                        ->label(__('library-media.labels.html'))
                        ->prepend(false)
                        ->value(trim(view('components.admin.table.library-media.html-clipboard-content', compact('libraryMedia'))->toHtml()))
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['rows' => 6, 'disabled']) }}
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary clipboard-copy" data-library-media-id="{{ $libraryMedia->id }}" data-type="html">
                            <i class="fas fa-link fa-fw"></i> @lang('library-media.labels.clipboardCopy')
                        </button>
                    </div>
                @endif
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('libraryMedia.index')->containerClasses(['mr-2']) }}
                    @if($libraryMedia){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
