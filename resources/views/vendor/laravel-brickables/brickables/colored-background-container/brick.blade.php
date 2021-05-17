@php
    $fullWidth = data_get($brick, 'data.full_width');
    $backgroundColor = App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS[data_get($brick, 'data.background_color')];
    $alignment = App\Brickables\ColoredBackgroundContainer::ALIGNMENTS[data_get($brick, 'data.alignment')];
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="my-3">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }} - {{ __('Full width:') }} {{ $fullWidth ? __('Yes') : __('No') }} - {{ __('Background color:') }} {{ __($backgroundColor['label']) }} - {{ __('Alignment:') }} {{ __($alignment['label']) }}.
            </div>
        </div>
    </div>
@endif
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
