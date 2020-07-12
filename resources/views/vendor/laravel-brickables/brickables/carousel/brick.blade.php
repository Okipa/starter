@php
    $carouselId = 'carousel-brick-' . $brick->id;
    $slides = $brick->getMedia('slides');
    $fullWidth = (bool) data_get($brick, 'data.full_width');
    $conversionName = $fullWidth ? 'full' : 'containerized';
@endphp
@unless($fullWidth)
    <div class="container">
        <div class="row">
@endunless
@include('components.common.bootstrap.carousel', compact('carouselId', 'slides', 'conversionName'))
@unless($fullWidth)
        </div>
    </div>
@endunless
