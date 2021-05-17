@php
    $carouselId = 'carousel-brick-' . $brick->id;
    $slides = $brick->slides->where('active', true)->sortBy('position');
    $fullWidth = data_get($brick, 'data.full_width');
    $conversionName = $fullWidth ? 'full' : 'containerized';
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="my-3">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }} - {{ __('Full width:') }} {{ $fullWidth ? __('Yes') : __('No') }}.
            </div>
        </div>
    </div>
@endif
@if($slides->isNotEmpty())
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
    <div id="{{ $carouselId }}" class="carousel slide bg-dark w-100" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $key => $slide)
                <div class="carousel-item{{ $loop->first ? ' active' : null }}">
                    {!! $slide->getFirstMedia('images')->img($conversionName, ['class' => 'img-fluid', 'alt' => $slide->name]) !!}
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
                <span class="sr-only">{{ __('Previous') }}</span>
            </a>
            <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{{ __('Next') }}</span>
            </a>
        @endif
    </div>
    @unless($fullWidth)
            </div>
        </div>
    @endunless
@elseif(request()->is('admin/*') || request()->is('*/admin/*'))
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
        <div>
            <i class="fas fa-info-circle fa-fw text-info"></i>
            {{ __('No slides were added to this carousel.') }}
        </div>
    @unless($fullWidth)
            </div>
        </div>
    @endunless
@endif

