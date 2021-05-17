@php
    $leftText = (new Parsedown)->text(translatedData($brick, 'data.text_left'));
    $rightImage = $brick->getFirstMedia('images');
    $rightResponsiveImage = $rightImage->img('half', ['class' => 'img-fluid', 'alt' => $rightImage->name]);
    $invertOrder = (bool) $brick['data']['invert_order'];
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="col my-3">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }} - {{ __('Invert order:') }} {{ $invertOrder ? __('Yes') : __('No') }}.
            </div>
        </div>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-sm-12 my-3 col-md-6 my-md-0 text">
            {!! $invertOrder ? $rightResponsiveImage : $leftText !!}
        </div>
        <div class="col-sm-12 my-3 col-md-6 my-md-0 text">
            {!! $invertOrder ? $leftText : $rightResponsiveImage !!}
        </div>
    </div>
</div>
