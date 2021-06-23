@php
    // ToDo: replace `translatedData` by `data_get` if your app is not multilingual.
    $leftText = (new Parsedown)->text(translatedData($brick, 'data.text_left'));
    $rightImage = $brick->getFirstMedia('images');
    $rightResponsiveImage = $rightImage->img('half', ['class' => 'img-fluid', 'alt' => $rightImage->name]);
    $invertOrder = (bool) $brick['data']['invert_order'];
@endphp
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
