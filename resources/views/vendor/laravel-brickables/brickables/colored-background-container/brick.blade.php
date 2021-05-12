<div class="d-flex flex-column {{ App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS[data_get($brick, 'data.background_color')]['classes'] }}">
    <div class="container">
        <div class="row {{ App\Brickables\ColoredBackgroundContainer::ALIGNMENTS[data_get($brick, 'data.alignment')]['classes'] }}">
            @foreach($brick->getBricks() as $subBrick)
                {{ $subBrick }}
            @endforeach
        </div>
    </div>
</div>
