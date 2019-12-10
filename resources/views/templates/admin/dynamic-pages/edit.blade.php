@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($dynamicPage)
            @lang('admin.title.orphan.edit', ['entity' => __('dynamic-pages.entities.dynamicPages'), 'detail' => $dynamicPage->title])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('dynamic-pages.entities.dynamicPages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $dynamicPage ? route('dynamicPage.update', $dynamicPage) : route('dynamicPage.store') }}"
          method="POST">
        @csrf
        @if($dynamicPage)
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
                <h3>@lang('admin.section.page')</h3>
                {{ bsText()->name('title')->model($dynamicPage)->containerHtmlAttributes(['required']) }}
                @if(! $dynamicPage)
                    {{ bsText()->name('slug')
                        ->model($dynamicPage)
                        ->prepend('<i class="fas fa-key fa-fw"></i>')
                        ->componentClasses(['slugify'])
                        ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                        ->containerHtmlAttributes(['required'])}}
                @endif
                {{ bsText()->name('url')
                    ->model($dynamicPage)
                    ->prepend(route('dynamicPage.show', ['url' => '']) . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->model($dynamicPage) }}
                @include('components.admin.seo.meta-tags', ['model' => $dynamicPage])
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('dynamicPages')->containerClasses(['mr-2']) }}
                    @if($dynamicPage){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>

    @if ($dynamicPage)
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('dynamic-pages.section.block')
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('dynamicPageBlock.store', $dynamicPage) }}" method="POST">
                    @csrf

                    {{ bsSelect()
                        ->name('block_id')
                        ->options(array_map(function (array $block, string $id) {
                            $block['id']   = $id;
                            $block['name'] = __($block['name']);

                            return $block;
                        }, config('dynamic-pages.blocks'), array_keys(config('dynamic-pages.blocks'))), 'id', 'name')
                        ->label(__('dynamic-pages.validation.attributes.block_id')) }}

                    <div class="d-flex pt-4">
                        {{ bsCreate() }}
                    </div>
                </form>
            </div>
            {{ $dynamicPage->blocks_table }}
        </div>
    @endif
@endsection
