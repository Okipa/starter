@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if ($dynamicPageBlock)
            @lang('admin.title.orphan.edit', ['entity' => __('dynamic-pages.entities.dynamicPageBlocks'), 'detail' => __(config('dynamic-pages.blocks.two_columns_paragraph.name')) ])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('dynamic-pages.entities.dynamicPageBlocks') ])
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
           <form action="{{ $dynamicPageBlock ? route('dynamicPageBlock.two_columns_paragraph.update', [ $dynamicPage, $dynamicPageBlock ]) : route('dynamicPageBlock.two_columns_paragraph.store', $dynamicPage) }}" method="POST">
               @csrf

               @if ($dynamicPageBlock)
                   @method('PUT')
               @endif

               @include('components.common.form.notice')

               {{ bsTextarea()
                   ->name('content_left')
                   ->model($dynamicPageBlock ? $dynamicPageBlock->blockable : null)
                   ->label('dynamic-pages.validation.attributes.two_columns_paragraph.content_left')
                   ->containerHtmlAttributes([ 'required' ]) }}

               {{ bsTextarea()
                   ->name('content_right')
                   ->model($dynamicPageBlock ? $dynamicPageBlock->blockable : null)
                   ->label('dynamic-pages.validation.attributes.two_columns_paragraph.content_right')
                   ->containerHtmlAttributes([ 'required' ]) }}

               <div class="d-flex pt-4">
                   {{ bsCancel()->route('dynamicPage.edit', compact('dynamicPage'))->containerClasses(['mr-2']) }}

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
