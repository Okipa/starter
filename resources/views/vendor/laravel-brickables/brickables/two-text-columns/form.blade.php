@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentClasses(['editor'])
        ->containerHtmlAttributes(['required']) }}
    {{ textarea()->name('text_right')
        ->locales(supportedLocaleKeys())
        ->prepend(null)->value(fn($locale) => translatedData($brick, 'data.text_right', $locale))
        ->componentClasses(['editor'])
        ->containerHtmlAttributes(['required']) }}
@endsection
