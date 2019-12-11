<div id="carouselTitleCaption" class="carousel slide bg-secondary" data-ride="carousel">
    @if($slides->count() > 1)
        <ol class="carousel-indicators">
            @foreach($slides as $index => $slide)
            <li data-target="#carouselTitleCaption" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>
    @endif
    <div class="carousel-inner h-100">
        @foreach($slides as $slide)
        <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">
            <div class="illustration h-100 lozad" data-background-image="{{ $slide->getFirstMediaUrl('illustrations', 'cover') }}">
            </div>
            <div class="carousel-caption">
                <h4>{{ $slide->title }}</h4>
                <p class="d-none d-md-block">{{ $slide->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @if($slides->count() > 1)
        <a class="carousel-control-prev" href="#carouselTitleCaption" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Previous')</span>
        </a>
        <a class="carousel-control-next" href="#carouselTitleCaption" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Next')</span>
        </a>
    @endif
</div>
