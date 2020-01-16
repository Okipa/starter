@extends('laravel-brickables::admin.form')
@section('inputs')
    {{ textarea()->name('left_text')->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
    @php($image = optional($brick)->getFirstMedia('bricks'))
    {{ inputFile()->name('right_image')
        ->value(optional($image)->file_name)
        ->uploadedFile(function() use ($image) {
            return $image
                ? image()->src($image->getUrl('thumb'))->linkUrl($image->getUrl())->linkTitle($image->name)
                : null;
        })
        ->showRemoveCheckbox(false)
        ->containerHtmlAttributes(['required'])
        ->legend($brickable->getBrickModel()->constraintsLegend('bricks')) }}
@endsection
