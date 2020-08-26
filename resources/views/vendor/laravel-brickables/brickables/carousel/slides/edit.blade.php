@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-chalkboard-teacher fa-fw"></i>
        @if($slide)
            @lang('breadcrumbs.parent.edit', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides'),
                'detail' => $slide->label
            ])
        @else
            @lang('breadcrumbs.parent.create', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides')
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $slide
        ? route('brick.carousel.slide.update', $slide)
        : route('brick.carousel.slide.store', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url]) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($slide)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Media')</h3>
                @php($image = optional($slide)->getFirstMedia('images'))
                {{ inputFile()->name('image')
                    ->value(optional($image)->file_name)
                    ->uploadedFile(fn() => $image ? image()->src($image->getUrl('thumb'))->linkUrl($image->getUrl())->linkTitle($image->name) : null)
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->caption((new \App\Models\Brickables\CarouselBrickSlide)->getMediaCaption('images')) }}
                <h3>@lang('Content')</h3>
                {{ inputText()->name('label')->model($slide)->locales(supportedLocaleKeys()) }}
                {{ inputText()->name('caption')->model($slide)->locales(supportedLocaleKeys())->prepend('<i class="fas fa-align-left"></i>') }}
                <h3>@lang('Publication')</h3>
                {{ inputToggle()->name('active')->model($slide) }}
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('brick.edit', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url])->containerClasses(['mr-2']) }}
                    @if($slide){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
