@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ inputText()->name('title')
        ->locales(supportedLocaleKeys())
        ->prepend(null)->value(fn($locale) => translatedData($brick, 'data.title', $locale))
        ->componentHtmlAttributes(['required']) }}
@endsection
