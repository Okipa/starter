@php
    $carouselId = 'carousel-brick-' . $brick->id;
    $slides = $brick->slides->where('active', true);
    $fullWidth = data_get($brick, 'data.full_width');
    $conversionName = $fullWidth ? 'full' : 'containerized';
@endphp
@if($slides->isNotEmpty())
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
    @include('components.common.bootstrap.carousel', compact('carouselId', 'slides', 'conversionName'))
    @unless($fullWidth)
            </div>
        </div>
    @endunless
@elseif(request()->is('admin/*') || request()->is('*/admin/*'))
    <i class="fas fa-info-circle fa-fw text-info mr-1"></i>
    @lang('No slides were added to this carousel.')
@endif

