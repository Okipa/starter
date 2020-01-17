@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('left_text')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use($brick) {
        return data_get($brick, 'left_text.' . $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
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
    {{ inputToggle()->name('invert_order')->checked((bool) data_get($brick, 'invert_order')) }}
@endsection
