@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($libraryMedia)
            @lang('admin.title.orphan.edit', [
                'entity' => __('entities.libraryMedia'), 'detail' => $libraryMedia->name,
            ])
        @else
            @lang('admin.title.orphan.create', [
                'entity' => __('entities.libraryMedia'),
            ])
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
                @php($mediaFile = optional($libraryMedia)->getFirstMedia('medias'))
                {{ bsFile()->name('media')
                    ->value(optional($mediaFile)->file_name)
                    ->uploadedFile(function() use ($mediaFile) {
                        return $mediaFile
                            ? image()->src($mediaFile->getUrl('thumb'))
                                ->linkUrl($mediaFile->getUrl())
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\LibraryMedia)->constraintsLegend('medias')) }}
                {{ bsText()->name('name')->model($libraryMedia)->containerHtmlAttributes(['required']) }}
                {{ bsToggle()->name('downloadable')->model($libraryMedia)->containerClasses(['form-group', 'mt-4']) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('libraryMedia.index')->containerClasses(['mr-2']) }}
                    @if($libraryMedia){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
