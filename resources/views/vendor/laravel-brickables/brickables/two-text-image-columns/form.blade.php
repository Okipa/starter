@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        ->locales(supportedLocaleKeys())
        ->prepend(false)
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentClasses(['editor'])
        ->containerHtmlAttributes(['required']) }}
    @php($image = optional($brick)->getFirstMedia('images'))
    {{ inputFile()->name('right_image')
        ->value(optional($image)->file_name)
        ->uploadedFile(fn() =>  $image ? image()->src($image->getUrl('thumb'))->linkUrl($image->getUrl())->linkTitle($image->name) : null)
        ->showRemoveCheckbox(false)
        ->containerHtmlAttributes(['required'])
        ->caption($brickable->getBrickModel()->constraintsCaption('images')) }}
    {{ inputToggle()->name('invert_order')->checked((bool) data_get($brick, 'data.invert_order')) }}
@endsection
