@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: remove localization if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
@endsection
