@php
    $leftText = (new Parsedown)->text(data_get($brick, 'data.left_text.' . app()->getLocale()));
    $rightImage = $brick->getFirstMedia('bricks');
    $rightResponsiveImage = $rightImage->img('image', ['class' => 'mw-100', 'alt' => $rightImage->name]);
    $invertOrder = data_get($brick, 'data.invert_order');
@endphp
<div class="row">
    <div class="col-sm-12 my-3 col-md-6 my-md-0">
        {!! $invertOrder ? $rightResponsiveImage : $leftText !!}
    </div>
    <div class="col-sm-12 my-3 col-md-6 my-md-0">
        {!! $invertOrder ? $leftText : $rightResponsiveImage !!}
    </div>
</div>
