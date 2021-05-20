@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-chalkboard-teacher fa-fw"></i>
        @if($slide)
            {{ __('breadcrumbs.parent.edit', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides'),
                'detail' => $slide->label
            ]) }}
        @else
            {{ __('breadcrumbs.parent.create', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides')
            ]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $slide
            ? route('brick.carousel.slide.update', $slide)
            : route('brick.carousel.slide.store', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url]) }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if($slide)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('brick.edit', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url])->containerClasses(['me-3']) }}
            @if($slide){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Information') }}">
                    @php($image = optional($slide)->getFirstMedia('images'))
                    {{ inputFile()->name('image')
                        ->value(optional($image)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
                        ->showRemoveCheckbox(false)
                        ->caption((new App\Models\Brickables\CarouselBrickSlide)->getMediaCaption('images'))
                        ->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('label')->model($slide)->locales(supportedLocaleKeys()) }}
                    {{ inputText()->name('caption')->model($slide)->locales(supportedLocaleKeys())->prepend('<i class="fas fa-align-left"></i>') }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    {{ inputSwitch()->name('active')->model($slide) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
