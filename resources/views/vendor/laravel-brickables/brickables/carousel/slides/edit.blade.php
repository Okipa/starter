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
        <div class="d-flex">
            {{ buttonBack()->route('brick.edit', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url])->containerClasses(['mr-3']) }}
            @if($slide){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <p>
            @include('components.common.form.notice')
        </p>
        <div class="card-columns">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2 class="m-0">
                        @lang('Identity')
                    </h2>
                </div>
                <div class="card-body">
                    @php($image = optional($slide)->getFirstMedia('images'))
                    {{ inputFile()->name('image')
                        ->value(optional($image)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
                        ->showRemoveCheckbox(false)
                        ->caption((new App\Models\Brickables\CarouselBrickSlide)->getMediaCaption('images'))
                        ->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('label')->model($slide)->locales(supportedLocaleKeys()) }}
                    {{ inputText()->name('caption')->model($slide)->locales(supportedLocaleKeys())->prepend('<i class="fas fa-align-left"></i>') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2 class="m-0">
                        @lang('Publication')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputToggle()->name('active')->model($slide) }}
                </div>
            </div>
        </div>
    </form>
@endsection
