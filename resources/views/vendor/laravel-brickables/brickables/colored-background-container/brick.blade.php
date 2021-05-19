@php
    $fullWidth = data_get($brick, 'data.full_width');
    $backgroundColor = App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS[data_get($brick, 'data.background_color')];
    $alignment = App\Brickables\ColoredBackgroundContainer::ALIGNMENTS[data_get($brick, 'data.alignment')];
@endphp
<div class="d-flex flex-column {{ $backgroundColor['classes'] }}">
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
    <div class="{{ $alignment['classes'] }}">
        @foreach($brick->getBricks() as $subBrick)
            {{ $subBrick }}
        @endforeach
    </div>
    @unless($fullWidth)
            </div>
        </div>
    @endunless
</div>
