@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if ($dynamicPageBlock)
            @lang('admin.title.orphan.edit', [
                'entity' => __('dynamic-pages::entities.dynamicPageBlocks'),
                'detail' => __(config('dynamic-pages.blocks.text_image.name')),
            ])
        @else
            @lang('admin.title.orphan.create', [
                'entity' => __('dynamic-pages::entities.dynamicPageBlocks'),
            ])
        @endif
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('admin.section.data')
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ $dynamicPageBlock ?
                    route('dynamic-pages::dynamicPageBlock.text_image.update', [ $dynamicPage, $dynamicPageBlock, 'blockId' => request()->query('blockId') ]) :
                    route('dynamic-pages::dynamicPageBlock.text_image.store', [ $dynamicPage, 'blockId' => request()->query('blockId') ]) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                @if ($dynamicPageBlock)
                    @method('PUT')
                @endif

                @include('components.common.form.notice')
                @php($image = optional(data_get($dynamicPageBlock, 'blockable'))->getFirstMedia('text_images'))

                {{ bsFile()
                     ->name('image')
                     ->value(optional($image)->file_name)
                     ->uploadedFile(function() use ($image) {
                         return $image
                             ? image()
                                 ->src($image->getUrl('thumb'))
                                 ->linkUrl($image->getUrl())
                                 ->containerClasses(['mb-2'])
                             : null;
                     })
                     ->showRemoveCheckbox(false)
                     ->label('dynamic-pages::validation.attributes.text_image.image')
                     ->containerHtmlAttributes(['required']) }}

                {{ bsTextarea()
                    ->name('content')
                    ->model($dynamicPageBlock ? $dynamicPageBlock->blockable : null)
                    ->label('dynamic-pages::validation.attributes.text_image.content')
                    ->containerHtmlAttributes([ 'required' ])
                    ->componentClasses(['editor'])
                    ->prepend(false) }}

                <div class="d-flex pt-4">
                    {{ bsCancel()->route('dynamic-pages::dynamicPage.edit', compact('dynamicPage'))->containerClasses(['mr-2']) }}

                    @if ($dynamicPageBlock)
                        {{ bsUpdate() }}
                    @else
                        {{ bsCreate() }}
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
