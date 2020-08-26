<div id="{{ $carouselId }}" class="carousel slide bg-dark w-100" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $key => $slide)
            <div class="carousel-item{{ $loop->first ? ' active' : null }}">
                {!! $slide->getFirstMedia('images')->img($conversionName, ['class' => 'w-100', 'alt' => $slide->name]) !!}
                @php
                    $label = $slide->label;
                    $caption = $slide->caption;
                @endphp
                @if($label || $caption)
                    <div class="carousel-caption d-none d-md-block">
                        @if($label)
                            <h5>{{ $label }}</h5>
                        @endif
                        @if($caption)
                            <p>{{ $caption }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if($slides->count() > 1)
        <ol class="carousel-indicators">
            @foreach($slides as $key => $slide)
                <li data-target="#{{ $carouselId }}"
                    data-slide-to="{{ $key }}"
                    class="{{ $loop->first ? 'active' : null }}"></li>
            @endforeach
        </ol>
        <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Previous')</span>
        </a>
        <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Next')</span>
        </a>
    @endif
</div>
