@extends('laravel-brickables::admin.form.layout')
@section('title')
    @lang('Add new slide')
@endsection
@section('inputs')
    {{ inputFile()->name('image')
        ->containerHtmlAttributes(['required'])
        ->caption($brickable->getBrickModel()->getMediaCaption('slides')) }}
    {{ inputText()->name('label')->locales(supportedLocaleKeys()) }}
    {{ inputText()->name('caption')->locales(supportedLocaleKeys())->prepend('<i class="fas fa-align-left"></i>') }}
@endsection
@section('actions')
    <div class="d-flex pt-4">
        {{ buttonCancel()->url($adminPanelUrl)->containerClasses(['mr-2']) }}
        {{ submitCreate() }}
    </div>
@endsection
@section('append')
    <div class="row mt-3">
        @php($slides = optional($brick)->getMedia('slides'))
        @if($slides && $slides->isNotEmpty())
            @foreach($slides as $slide)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="m-0">#{{ $loop->iteration }}</h3>
                            <div class="d-flex">
                                <form role="form" method="POST" action="{{ route('brick.carousel.slide.move.up', $slide) }}">
                                    @csrf
                                    {{ submit()->prepend('<i class="fas fa-long-arrow-alt-up fa-fw"></i>')
                                        ->componentClasses(['btn-link'])
                                        ->componentHtmlAttributes(['title' => __('Move up')]) }}
                                </form>
                                <form role="form" method="POST" action="{{ route('brick.carousel.slide.move.down', $slide) }}">
                                    @csrf
                                    {{ submit()->prepend('<i class="fas fa-long-arrow-alt-down fa-fw"></i>')
                                        ->componentClasses(['btn-link'])
                                        ->componentHtmlAttributes(['title' => __('Move down')]) }}
                                </form>
                                <form role="form"
                                      method="POST"
                                      action="{{ route('brick.carousel.slide.destroy', $slide) }}">
                                    @csrf
                                    @method('DELETE')
                                    {{ submit()->prepend('<i class="fas fa-trash fa-fw text-danger"></i>')
                                        ->componentClasses(['btn-link'])
                                        ->componentHtmlAttributes(['data-confirm' => __('notifications.orphan.destroyConfirm', [
                                            'entity' => __('Slide'),
                                            'name' => $slide->name,
                                        ])]) }}
                                </form>
                            </div>
                        </div>
                        {!! $slide->img('full', ['class' => 'w-100 card-img-top', 'alt' => $slide->name]) !!}
                        @php($label = translatedData($slide->getCustomProperty('label')))
                        @php($caption = translatedData($slide->getCustomProperty('caption')))
                        @if($label || $caption)
                            <div class="card-body">
                                @if($label)
                                    <h5 class="card-title">{{ $label }}</h5>
                                @endif
                                @if($caption)
                                    <p class="card-text">{{ $caption }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
