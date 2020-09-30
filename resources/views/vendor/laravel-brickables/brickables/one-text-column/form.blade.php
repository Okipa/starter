@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text')
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        ->value(fn($locale) => translatedData($brick, 'data.text', $locale))
        ->componentClasses(['editor'])
        ->componentHtmlAttributes(['required']) }}
@endsection
