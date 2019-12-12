@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($dynamicPage)
            @lang('admin.title.orphan.edit', ['entity' => __('dynamic-pages::entities.dynamicPages'), 'detail' => $dynamicPage->title])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('dynamic-pages::entities.dynamicPages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $dynamicPage ? route('dynamic-pages::dynamicPage.update', $dynamicPage) : route('dynamic-pages::dynamicPage.store') }}"
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
                    ->prepend(route('dynamic-pages::dynamicPage.show', ['url' => '']) . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->model($dynamicPage) }}
                @include('components.admin.seo.meta-tags', ['model' => $dynamicPage])
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('dynamic-pages::dynamicPages')->containerClasses(['mr-2']) }}
                    @if($dynamicPage){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>

    @if ($dynamicPage)
        <div class="card mt-4">
            <div class="card-header">
                <form action="{{ route('dynamic-pages::dynamicPageBlock.store', $dynamicPage) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            {{ bsSelect()
                                ->name('block_id')
                                ->options(array_map(function (array $block, string $id) {
                                    $block['id']   = $id;
                                    $block['name'] = __($block['name']);

                                    return $block;
                                }, config('dynamic-pages.blocks'), array_keys(config('dynamic-pages.blocks'))), 'id', 'name')
                                ->label(__('dynamic-pages::validation.attributes.block_id')) }}
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            {{ bsCreate()
                                ->label(__('dynamic-pages::buttons.create_block'))
                                ->componentClasses([ 'btn btn-success w-100' ]) }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>@lang('dynamic-pages::validation.attributes.block_id')</th>
                            <th class="text-right">@lang('dynamic-pages::validation.attributes.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (data_get($dynamicPage, 'blocks', []) as $block)
                            <tr>
                                <td>{{ data_get($block, 'translated_name') }}</td>
                                <td class="text-right">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-link p-0 text-success"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#preview-{{ data_get($block, 'id') }}">
                                            <i class="fas fa-fw fa-eye"></i>
                                        </button>
                                        <form action="{{ route('dynamic-pages::dynamicPageBlock.edit', [ $dynamicPage, $block ]) }}"
                                              method="GET"
                                              class="ml-2"
                                              id="edit-{{ data_get($block, 'id') }}"
                                              role="form">
                                            @csrf
                                            <button class="btn btn-link p-0 text-primary load-on-click" type="submit">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('dynamic-pages::dynamicPageBlock.destroy', [ $dynamicPage, $block ]) }}"
                                              method="POST"
                                              class="ml-2 destroy"
                                              id="destroy-{{ data_get($block, 'id') }}"
                                              role="form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link p-0 text-danger"
                                                    type="submit"
                                                    data-confirm="@lang('notifications.message.crud.name.destroyConfirm', [ 'name' => data_get($block, 'translated_name') ])">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse" id="preview-{{ data_get($block, 'id') }}">
                                <td colspan="2" class="overflow-hidden">
                                    {{ $block->html() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
